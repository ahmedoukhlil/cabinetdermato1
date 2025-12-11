<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Facture;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;
use App\Http\Resources\Admin\FactureResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FactureApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FactureResource(Facture::with(['status', 'user'])->get());
    }

    public function store(StoreFactureRequest $request)
    {
        $facture = Facture::create($request->all());

        return (new FactureResource($facture))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Facture $facture)
    {
        abort_if(Gate::denies('facture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FactureResource($facture->load(['status', 'user']));
    }

    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        $facture->update($request->all());

        return (new FactureResource($facture))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Facture $facture)
    {
        abort_if(Gate::denies('facture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facture->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
