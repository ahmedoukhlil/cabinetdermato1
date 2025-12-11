<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaiementStatusRequest;
use App\Http\Requests\UpdatePaiementStatusRequest;
use App\Http\Resources\Admin\PaiementStatusResource;
use App\PaiementStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaiementStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('paiement_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaiementStatusResource(PaiementStatus::all());
    }

    public function store(StorePaiementStatusRequest $request)
    {
        $paiementStatus = PaiementStatus::create($request->all());

        return (new PaiementStatusResource($paiementStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaiementStatus $paiementStatus)
    {
        abort_if(Gate::denies('paiement_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaiementStatusResource($paiementStatus);
    }

    public function update(UpdatePaiementStatusRequest $request, PaiementStatus $paiementStatus)
    {
        $paiementStatus->update($request->all());

        return (new PaiementStatusResource($paiementStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaiementStatus $paiementStatus)
    {
        abort_if(Gate::denies('paiement_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiementStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
