<?php

namespace App\Http\Controllers\Admin;

use App\Fournisseur;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFournisseurRequest;
use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use DB;

class FournisseursController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('fournisseur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fournisseur::with(['user'])->select(sprintf('%s.*', (new Fournisseur)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fournisseur_show';
                $editGate = 'fournisseur_edit';
                $deleteGate = 'fournisseur_delete';
                $crudRoutePart = 'fournisseurs';

                return view('partials.datatablesActions', compact(
                                'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('solde', function ($row) {
                return $row->solde ? $row->solde : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fournisseurs.index');
    }

    public function create() {
        abort_if(Gate::denies('fournisseur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.fournisseurs.create');
    }

    public function store(StoreFournisseurRequest $request) {
        $fournisseur = Fournisseur::create($request->all() + ['user_id' => Auth::user()->id]);

        $fournisseur->load('commandes');
        return view('admin.fournisseurs.show', compact('fournisseur'));

//        return redirect()->route('admin.fournisseurs.index');
    }

    public function paiement(Fournisseur $fournisseur) {
        abort_if(Gate::denies('fournisseur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($fournisseur->solde < 1) {
            return redirect()->back()->withErrors('Solde fournisseur est correct');
        }
        return view('admin.commandePaiements.create', compact('fournisseur'));
    }

    public function storePaiement(Request $request) {
        abort_if(Gate::denies('fournisseur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $paiement = $request->all();
//        dd($paiement['fournisseur_id']);
        $fournisseur = Fournisseur::findOrFail($paiement['fournisseur_id']);
        if ($paiement['montant'] > $fournisseur->solde) {
            return redirect()->back()->withErrors('Montant de paiement supérieur du solde')->withInput();
        }
        DB::beginTransaction();
        $fournisseur->paiements()->create($paiement + ['user_id' => Auth::user()->id]);
        $updated = array('solde' => DB::raw("solde - {$paiement['montant']}"));
        $fournisseur->update($updated);
        DB::commit();
        $fournisseur = Fournisseur::findOrFail($paiement['fournisseur_id']);
//        dd($request->all());
        return redirect()->route('admin.fournisseurs.show', compact('fournisseur'));
    }

    public function edit(Fournisseur $fournisseur) {
        abort_if(Gate::denies('fournisseur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.fournisseurs.edit', compact('fournisseur'));
    }

    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur) {
        $fournisseur->update($request->all());

        return redirect()->route('admin.fournisseurs.index');
    }

    public function show(Fournisseur $fournisseur) {
        abort_if(Gate::denies('fournisseur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fournisseur->load('commandes');

        return view('admin.fournisseurs.show', compact('fournisseur'));
    }

    public function destroy(Fournisseur $fournisseur) {
        abort_if(Gate::denies('fournisseur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fournisseur->delete();

        return back();
    }

    public function massDestroy(MassDestroyFournisseurRequest $request) {
        Fournisseur::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
