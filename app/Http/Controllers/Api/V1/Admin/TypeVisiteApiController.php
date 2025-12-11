<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeVisiteRequest;
use App\Http\Requests\UpdateTypeVisiteRequest;
use App\Http\Resources\Admin\TypeVisiteResource;
use App\TypeVisite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeVisiteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_visite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeVisiteResource(TypeVisite::all());
    }

    public function store(StoreTypeVisiteRequest $request)
    {
        $typeVisite = TypeVisite::create($request->all());

        return (new TypeVisiteResource($typeVisite))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeVisite $typeVisite)
    {
        abort_if(Gate::denies('type_visite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeVisiteResource($typeVisite);
    }

    public function update(UpdateTypeVisiteRequest $request, TypeVisite $typeVisite)
    {
        $typeVisite->update($request->all());

        return (new TypeVisiteResource($typeVisite))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeVisite $typeVisite)
    {
        abort_if(Gate::denies('type_visite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeVisite->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
