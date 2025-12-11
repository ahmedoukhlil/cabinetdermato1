<?php

namespace App\Http\Controllers\Admin;

use App\CashRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCashRegisterRequest;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashRegistersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cash_register_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashRegisters = CashRegister::all();

        return view('admin.cashRegisters.index', compact('cashRegisters'));
    }

    public function create()
    {
        abort_if(Gate::denies('cash_register_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashRegisters.create');
    }

    public function store(StoreCashRegisterRequest $request)
    {
        $cashRegister = CashRegister::create($request->all());

        return redirect()->route('admin.cash-registers.index');
    }

    public function edit(CashRegister $cashRegister)
    {
        abort_if(Gate::denies('cash_register_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashRegisters.edit', compact('cashRegister'));
    }

    public function update(UpdateCashRegisterRequest $request, CashRegister $cashRegister)
    {
        $cashRegister->update($request->all());

        return redirect()->route('admin.cash-registers.index');
    }

    public function show(CashRegister $cashRegister)
    {
        abort_if(Gate::denies('cash_register_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashRegister->load('caisseSoins', 'caisseOperationCashes');

        return view('admin.cashRegisters.show', compact('cashRegister'));
    }

    public function destroy(CashRegister $cashRegister)
    {
        abort_if(Gate::denies('cash_register_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashRegister->delete();

        return back();
    }

    public function massDestroy(MassDestroyCashRegisterRequest $request)
    {
        CashRegister::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
