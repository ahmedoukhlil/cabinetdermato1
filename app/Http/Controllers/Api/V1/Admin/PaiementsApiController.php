<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Http\Resources\Admin\PaiementResource;
use App\Paiement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaiementsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('paiement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaiementResource(Paiement::with(['facture', 'user'])->get());
    }

    public function store(StorePaiementRequest $request)
    {
        $paiement = Paiement::create($request->all());

        return (new PaiementResource($paiement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Paiement $paiement)
    {
        abort_if(Gate::denies('paiement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaiementResource($paiement->load(['facture', 'user']));
    }

    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $paiement->update($request->all());

        return (new PaiementResource($paiement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Paiement $paiement)
    {
        abort_if(Gate::denies('paiement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
