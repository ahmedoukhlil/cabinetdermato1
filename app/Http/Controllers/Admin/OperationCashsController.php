<?php

namespace App\Http\Controllers\Admin;

use App\CashRegister;
use App\Medecin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOperationCashRequest;
use App\Http\Requests\StoreOperationCashRequest;
use App\Http\Requests\UpdateOperationCashRequest;
use App\OperationCash;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OperationCashsController extends Controller {

    public function index() {
        abort_if(Gate::denies('operation_cash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operationCashes = OperationCash::all();

        return view('admin.operationCashes.index', compact('operationCashes'));
    }

    public function create() {
        abort_if(Gate::denies('operation_cash_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caisses = CashRegister::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.operationCashes.create', compact('caisses', 'medecins'));
    }

    public function store(StoreOperationCashRequest $request) {
        if ((int) $request->all()['montant'] < 1) {
            return redirect()->back()->withErrors('Montant invalide')->withInput();
        }
        $caisse = \App\CashRegister::findOrFail($request->all()['caisse_id']);
        if ($request->all()['montant'] > $caisse->solde) {
            return redirect()->back()->withErrors('Montant indisponible dans la caisse')->withInput();
        }
        DB::beginTransaction();
        $operationCash = OperationCash::create($request->all() + ['user_id' => Auth::user()->id]);
        $updated = array('solde' => DB::raw("solde - {$request->all()['montant']}"));
        \App\CashRegister::where('id', $request->all()['caisse_id'])->update($updated);
        if (1 != $request->all()['caisse_id']) {
            $updated = array('solde_soins' => DB::raw("solde_soins - {$request->all()['montant']}"));
            \App\Medecin::where('id', $request->all()['medecin_id'])->update($updated);
        }
        DB::commit();

        $operationCash->load('caisse', 'medecin', 'user');
        return view('admin.operationCashes.show', compact('operationCash'));
        return redirect()->route('admin.operation-cashes.index');
    }

    public function edit(OperationCash $operationCash) {
        abort_if(Gate::denies('operation_cash_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caisses = CashRegister::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $operationCash->load('caisse', 'medecin', 'user');

        return view('admin.operationCashes.edit', compact('caisses', 'medecins', 'operationCash'));
    }

    public function update(UpdateOperationCashRequest $request, OperationCash $operationCash) {
        if ((int) $request->all()['montant'] < 1) {
            return redirect()->back()->withErrors('Montant invalide')->withInput();
        }
        DB::beginTransaction();
        $oldAmount = $operationCash->montant;
        $updated = array('solde' => DB::raw("solde + {$operationCash->montant}"));
        \App\CashRegister::where('id', $operationCash->caisse_id)->update($updated);
        $caisse = \App\CashRegister::findOrFail($request->all()['caisse_id']);
        if ($request->all()['montant'] > $caisse->solde) {
            return redirect()->back()->withErrors('Montant indisponible dans la caisse')->withInput();
        }
        $operationCash->update($request->all());
        $updated = array('solde' => DB::raw("solde - {$request->all()['montant']}"));
        \App\CashRegister::where('id', $request->all()['caisse_id'])->update($updated);
        DB::commit();
        return redirect()->route('admin.operation-cashes.index');
    }

    public function show(OperationCash $operationCash) {
        abort_if(Gate::denies('operation_cash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operationCash->load('caisse', 'medecin', 'user');

        return view('admin.operationCashes.show', compact('operationCash'));
    }

    public function destroy(OperationCash $operationCash) {
        abort_if(Gate::denies('operation_cash_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        $updated = array('solde' => DB::raw("solde + {$operationCash->montant}"));
        \App\CashRegister::where('id', $operationCash->caisse_id)->update($updated);
        $operationCash->delete();
        DB::commit();

        return back();
    }

    public function massDestroy(MassDestroyOperationCashRequest $request) {
        OperationCash::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
