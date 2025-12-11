<?php

namespace App\Http\Controllers\Admin;

use App\Soin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySoinRequest;
use App\Http\Requests\StoreSoinRequest;
use App\Http\Requests\UpdateSoinRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SoinsController extends Controller {

    public function index2() {
        abort_if(Gate::denies('soin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $soins = Soin::all();

        return view('admin.soins.index', compact('soins'));
    }

    public function index(Request $request) {
        abort_if(Gate::denies('soin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->has('soin_to_date')) {
            $qry = Soin::when(request('soin_from_date'), function ($q) {
                        return $q->whereDate('created_at', '>=', date('Y-m-d', strtotime(request('soin_from_date'))));
                    })
                    ->when(request('soin_to_date'), function ($q) {
                return $q->whereDate('created_at', '<=', date('Y-m-d', strtotime(request('soin_to_date'))));
            });
            $soins = $qry->orderByDesc('id')->get();
            $sumSoins = $qry->sum('montant');
            $soin_from_date = request('soin_from_date');
            $soin_to_date = request('soin_to_date');
        } else {
            $qry = Soin::whereDate('created_at', Carbon::today());
            $soins = $qry->with(['status', 'user'])->orderByDesc('id')->get();
            $sumSoins = $qry->sum('montant');
            $soin_from_date = $soin_to_date = date('d-m-Y');
        }

        return view('admin.soins.index', compact('soins', 'sumSoins', 'soin_from_date', 'soin_to_date'));
    }

    public function create() {
        abort_if(Gate::denies('soin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = \App\TypeSoin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $patients = \App\Patient::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $medecins = \App\Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.soins.create', compact('patients', 'types', 'medecins'));
    }

    public function createWP(\App\Patient $patient) {
        abort_if(Gate::denies('soin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = \App\TypeSoin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $medecins = \App\Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.soins.createWP', compact('patient', 'types', 'medecins'));
    }

    public function store(StoreSoinRequest $request) {
//        return dd($request->has('soin_details') && is_array($request->soin_details) && count($request->soin_details));
//        DB::enableQueryLog();
        DB::beginTransaction();
        $total = 0;
        $soin = Soin::create($request->all() + ['montant' => $total, 'user_id' => Auth::user()->id, 'reference' => 'Soin/' . $request->all()['patient_id'] . '/' . date('YmdHis')]);
        $line = 1;
        foreach ($request->input('soin_details', []) as $data) {
            $montant = $data['quantity'] * $data['prix_unitaire'];
            $total += $montant;
            if ($montant <= 0) {
                DB::rollback();
                return redirect()->back()->withErrors("Merci de vérifier la ligne {$line} Quantité ou Prix Unitaire incorrect")->withInput();
            }
            $line += 1;
            $soin->details()->create($data + ['montant' => $montant]);
            $typeSoin = \App\TypeSoin::findOrFail($data['type_id']);
            $updated = array('solde' => DB::raw("solde + {$montant}"));
            \App\CashRegister::where('id', $typeSoin->caisse_id)->update($updated);
        }
        $soin->update(['montant' => $total]);
        $updated = array('ca' => DB::raw("ca + {$total}"), 'solde' => DB::raw("solde + {$total}"));
        \App\Patient::where('id', request('patient_id'))->update($updated);
        $updated = array('solde_soins' => DB::raw("solde_soins + {$total}"));
        \App\Medecin::where('id', request('medecin_id'))->update($updated);
        \App\Facture::create([
            'montant' => $total,
            'factureable_type' => 'App\\Soin',
            'factureable_id' => $soin->id,
            'patient_id' => $request->all()['patient_id'],
            'reference' => 'Inv/Soin/Id/' . $soin->id,
            'user_id' => Auth::user()->id,
        ]);

        if ($total <= 0) {
            DB::rollback();
            return redirect()->back()->withErrors("Montant total de la facture est incorrecte")->withInput();
        }

//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();

        return redirect()->route('admin.soins.index');
    }

    public function edit(Soin $soin) {
        abort_if(Gate::denies('soin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $soin->load('user');

        return view('admin.soins.edit', compact('users', 'soin'));
    }

    public function update(UpdateSoinRequest $request, Soin $soin) {
        $soin->update($request->all());

        return redirect()->route('admin.soins.index');
    }

    public function soinPrint(Soin $soin) {
//        dd($soin);
        abort_if(Gate::denies('soin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image = public_path() . '\images\Header.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $HeadImage = base64_encode($data);
        ini_set("pcre.backtrack_limit", "5000000");
        $soin->load('medecin', 'patient');
        $config = ['format' => 'A5-P', 'default_font_size' => 11, 'margin_left' => 5, 'margin_right' => 5, 'margin_top' => 5];
//        return View('admin.soins.print', compact('soin', 'HeadImage'));        
        $pdf = PDF::loadView('admin.soins.print', compact('soin', 'HeadImage'), [], $config);
        return $pdf->stream();
    }

    public function show(Soin $soin) {
        abort_if(Gate::denies('soin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $soin->load('user', 'details');

        return view('admin.soins.show', compact('soin'));
    }

    public function destroy(Soin $soin) {
        abort_if(Gate::denies('soin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $soin->delete();

        return back();
    }

    public function massDestroy(MassDestroySoinRequest $request) {
        Soin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
