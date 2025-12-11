<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use App\Facture;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaiementRequest;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Paiement;
use App\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class PaiementsController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('paiement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Paiement::with(['user'])->select(sprintf('%s.*', (new Paiement)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'paiement_show';
                $editGate = 'paiement_edit';
                $deleteGate = 'paiement_delete';
                $crudRoutePart = 'paiements';

                return view('partials.datatablesActions', compact(
                                'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->editColumn('reference', function ($row) {
                return $row->reference ? $row->reference : "";
            });
            $table->editColumn('montant', function ($row) {
                return $row->montant ? $row->montant : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.paiements.index');
    }

    public function create(Patient $patient) {
        abort_if(Gate::denies('paiement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paiements.create', compact('patient'));
    }

    public function getCaisseId(Facture $facture) {
        if ('App\Soin' == $facture->factureable_type) {
            return 2;
        } else {
            return 1;
        }
    }

    public function store(StorePaiementRequest $request) {
        if((int) $request->all()['montant'] < 1){
            return redirect()->back()->withErrors("Montant de paiement invalide")->withInput();
        }
        DB::beginTransaction();
//        DB::enableQueryLog();
        $paiement = Paiement::create($request->all() + ['reference' => 'Paiement/' . $request->all()['patient_id'] . '/' . date('YmdHis'), 'user_id' => Auth::user()->id]);
        $total = 0;
        $line = 1;
        if ($request->has('paiement_details') && count($request->all()['paiement_details'])) {
            foreach ($request->input('paiement_details', []) as $data) {
                $total += $data['montant'];
                $facture = \App\Facture::findOrFail($data['facture_id']);
                if ($facture->montant_encaisse + $data['montant'] > $facture->montant) {
                    DB::rollback();
                    return redirect()->back()->withErrors("Montant de la ligne {$line} est superieur du montant restant")->withInput();
                }
                $line += 1;
                $caisse_id = $this->getCaisseId($facture);
                $paiement->details()->create($data + ['caisse_id' => $caisse_id]);  //Insert details

                $updated = array('solde' => DB::raw("solde + {$data['montant']}"));
                \App\CashRegister::where('id', $caisse_id)->update($updated);       // Update caisse

                $updated = array('montant_encaisse' => DB::raw("montant_encaisse + {$data['montant']}"));
                \App\Facture::where('id', $facture->id)->update($updated);          //Update facture
            }
        }
        $updated = array('solde' => DB::raw("solde - {$total}"));
        \App\Patient::where('id', $facture->patient_id)->update($updated);                // Update solde patient
        $paiement->montant = $total;
        $paiement->save();
//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();
        return redirect()->route('admin.paiements.index');
    }

    public function edit(Paiement $paiement) {
        abort_if(Gate::denies('paiement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->load('facture', 'user');

        return view('admin.paiements.edit', compact('paiement'));
    }

    public function update(UpdatePaiementRequest $request, Paiement $paiement) {
        $paiement->update($request->all());

        return redirect()->route('admin.paiements.index');
    }

    public function show(Paiement $paiement) {
        abort_if(Gate::denies('paiement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->load('details', 'user');

        return view('admin.paiements.show', compact('paiement'));
    }

    public function destroy(Paiement $paiement) {
        abort_if(Gate::denies('paiement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->delete();

        return back();
    }

    public function deleteDetail($id) {
        abort_if(Gate::denies('paiement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();
//        DB::enableQueryLog();
        $paiement = \App\PaiementDetail::findOrFail($id);

        $updated = array('solde' => DB::raw("solde - {$paiement->montant}"));
        \App\CashRegister::where('id', $paiement->caisse_id)->update($updated);       // Update caisse

        $updated = array('montant_encaisse' => DB::raw("montant_encaisse - {$paiement->montant}"));
        \App\Facture::where('id', $paiement->facture_id)->update($updated);          //Update facture

        $updated = array('solde' => DB::raw("solde + {$paiement->montant}"));
        \App\Patient::where('id', $paiement->facture->patient_id)->update($updated);                // Update solde patient

        $updated = array('montant' => DB::raw("montant - {$paiement->montant}"));
        \App\Paiement::where('id', $paiement->paiement_id)->update($updated);                // Update Paiement principal

        $paiement->delete();

//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();
        return back();
    }

    public function massDestroy(MassDestroyPaiementRequest $request) {
        Paiement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
