<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\FactureStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFactureStatusRequest;
use App\Http\Requests\UpdateFactureStatusRequest;
use App\Http\Resources\Admin\FactureStatusResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FactureStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facture_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FactureStatusResource(FactureStatus::all());
    }

    public function store(StoreFactureStatusRequest $request)
    {
        $factureStatus = FactureStatus::create($request->all());

        return (new FactureStatusResource($factureStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FactureStatus $factureStatus)
    {
        abort_if(Gate::denies('facture_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FactureStatusResource($factureStatus);
    }

    public function update(UpdateFactureStatusRequest $request, FactureStatus $factureStatus)
    {
        $factureStatus->update($request->all());

        return (new FactureStatusResource($factureStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FactureStatus $factureStatus)
    {
        abort_if(Gate::denies('facture_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $factureStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
