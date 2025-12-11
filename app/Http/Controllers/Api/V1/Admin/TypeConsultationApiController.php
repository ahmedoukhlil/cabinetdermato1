<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeConsultationRequest;
use App\Http\Requests\UpdateTypeConsultationRequest;
use App\Http\Resources\Admin\TypeConsultationResource;
use App\TypeConsultation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeConsultationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_consultation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeConsultationResource(TypeConsultation::all());
    }

    public function store(StoreTypeConsultationRequest $request)
    {
        $typeConsultation = TypeConsultation::create($request->all());

        return (new TypeConsultationResource($typeConsultation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeConsultation $typeConsultation)
    {
        abort_if(Gate::denies('type_consultation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeConsultationResource($typeConsultation);
    }

    public function update(UpdateTypeConsultationRequest $request, TypeConsultation $typeConsultation)
    {
        $typeConsultation->update($request->all());

        return (new TypeConsultationResource($typeConsultation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeConsultation $typeConsultation)
    {
        abort_if(Gate::denies('type_consultation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeConsultation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
