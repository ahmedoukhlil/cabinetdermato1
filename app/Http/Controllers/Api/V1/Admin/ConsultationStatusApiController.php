<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ConsultationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationStatusRequest;
use App\Http\Requests\UpdateConsultationStatusRequest;
use App\Http\Resources\Admin\ConsultationStatusResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultationStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('consultation_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConsultationStatusResource(ConsultationStatus::all());
    }

    public function store(StoreConsultationStatusRequest $request)
    {
        $consultationStatus = ConsultationStatus::create($request->all());

        return (new ConsultationStatusResource($consultationStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ConsultationStatus $consultationStatus)
    {
        abort_if(Gate::denies('consultation_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConsultationStatusResource($consultationStatus);
    }

    public function update(UpdateConsultationStatusRequest $request, ConsultationStatus $consultationStatus)
    {
        $consultationStatus->update($request->all());

        return (new ConsultationStatusResource($consultationStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ConsultationStatus $consultationStatus)
    {
        abort_if(Gate::denies('consultation_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
