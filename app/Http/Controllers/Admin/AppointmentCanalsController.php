<?php

namespace App\Http\Controllers\Admin;

use App\AppointmentCanal;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentCanalRequest;
use App\Http\Requests\StoreAppointmentCanalRequest;
use App\Http\Requests\UpdateAppointmentCanalRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentCanalsController extends Controller {

    public function index() {
        abort_if(Gate::denies('appointment_canal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentCanals = AppointmentCanal::all();

        return view('admin.appointmentCanals.index', compact('appointmentCanals'));
    }

    public function create() {
        abort_if(Gate::denies('appointment_canal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentCanals.create');
    }

    public function store(StoreAppointmentCanalRequest $request) {
        $appointmentCanal = AppointmentCanal::create($request->all());

        return redirect()->route('admin.appointment-canals.index');
    }

    public function edit(AppointmentCanal $appointmentCanal) {
        abort_if(Gate::denies('appointment_canal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentCanals.edit', compact('appointmentCanal'));
    }

    public function update(UpdateAppointmentCanalRequest $request, AppointmentCanal $appointmentCanal) {
        $appointmentCanal->update($request->all());

        return redirect()->route('admin.appointment-canals.index');
    }

    public function show(AppointmentCanal $appointmentCanal) {
        abort_if(Gate::denies('appointment_canal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentCanals.show', compact('appointmentCanal'));
    }

    public function destroy(AppointmentCanal $appointmentCanal) {
        abort_if(Gate::denies('appointment_canal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentCanal->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentCanalRequest $request) {
        AppointmentCanal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
