<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CashRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use App\Http\Resources\Admin\CashRegisterResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashRegistersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cash_register_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashRegisterResource(CashRegister::all());
    }

    public function store(StoreCashRegisterRequest $request)
    {
        $cashRegister = CashRegister::create($request->all());

        return (new CashRegisterResource($cashRegister))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CashRegister $cashRegister)
    {
        abort_if(Gate::denies('cash_register_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashRegisterResource($cashRegister);
    }

    public function update(UpdateCashRegisterRequest $request, CashRegister $cashRegister)
    {
        $cashRegister->update($request->all());

        return (new CashRegisterResource($cashRegister))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CashRegister $cashRegister)
    {
        abort_if(Gate::denies('cash_register_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashRegister->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
