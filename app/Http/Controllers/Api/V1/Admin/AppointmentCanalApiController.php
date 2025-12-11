<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentCanalRequest;
use App\Http\Requests\UpdateAppointmentCanalRequest;
use App\Http\Resources\Admin\AppointmentCanalResource;
use App\AppointmentCanal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentCanalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_prise_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentCanalResource(AppointmentCanal::all());
    }

    public function store(StoreAppointmentCanalRequest $request)
    {
        $appointmentCanal = AppointmentCanal::create($request->all());

        return (new AppointmentCanalResource($appointmentCanal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentCanal $appointmentCanal)
    {
        abort_if(Gate::denies('type_prise_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentCanalResource($appointmentCanal);
    }

    public function update(UpdateAppointmentCanalRequest $request, AppointmentCanal $appointmentCanal)
    {
        $appointmentCanal->update($request->all());

        return (new AppointmentCanalResource($appointmentCanal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentCanal $appointmentCanal)
    {
        abort_if(Gate::denies('type_prise_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentCanal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
