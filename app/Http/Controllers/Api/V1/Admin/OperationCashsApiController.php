<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOperationCashRequest;
use App\Http\Requests\UpdateOperationCashRequest;
use App\Http\Resources\Admin\OperationCashResource;
use App\OperationCash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperationCashsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('operation_cash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperationCashResource(OperationCash::with(['caisse', 'medecin', 'user'])->get());
    }

    public function store(StoreOperationCashRequest $request)
    {
        $operationCash = OperationCash::create($request->all());

        return (new OperationCashResource($operationCash))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OperationCash $operationCash)
    {
        abort_if(Gate::denies('operation_cash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperationCashResource($operationCash->load(['caisse', 'medecin', 'user']));
    }

    public function update(UpdateOperationCashRequest $request, OperationCash $operationCash)
    {
        $operationCash->update($request->all());

        return (new OperationCashResource($operationCash))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OperationCash $operationCash)
    {
        abort_if(Gate::denies('operation_cash_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operationCash->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
