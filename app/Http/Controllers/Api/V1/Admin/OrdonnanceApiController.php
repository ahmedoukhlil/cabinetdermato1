<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOrdonnanceRequest;
use App\Http\Requests\UpdateOrdonnanceRequest;
use App\Http\Resources\Admin\OrdonnanceResource;
use App\Ordonnance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdonnanceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ordonnance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdonnanceResource(Ordonnance::with(['medecin', 'patient', 'consultation'])->get());
    }

    public function store(StoreOrdonnanceRequest $request)
    {
        $ordonnance = Ordonnance::create($request->all());

        return (new OrdonnanceResource($ordonnance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ordonnance $ordonnance)
    {
        abort_if(Gate::denies('ordonnance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdonnanceResource($ordonnance->load(['medecin', 'patient', 'consultation']));
    }

    public function update(UpdateOrdonnanceRequest $request, Ordonnance $ordonnance)
    {
        $ordonnance->update($request->all());

        return (new OrdonnanceResource($ordonnance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ordonnance $ordonnance)
    {
        abort_if(Gate::denies('ordonnance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordonnance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
