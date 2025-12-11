<?php

namespace App\Http\Controllers\Admin;

use App\ConsultationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConsultationStatusRequest;
use App\Http\Requests\StoreConsultationStatusRequest;
use App\Http\Requests\UpdateConsultationStatusRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultationStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('consultation_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationStatuses = ConsultationStatus::all();

        return view('admin.consultationStatuses.index', compact('consultationStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('consultation_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultationStatuses.create');
    }

    public function store(StoreConsultationStatusRequest $request)
    {
        $consultationStatus = ConsultationStatus::create($request->all());

        return redirect()->route('admin.consultation-statuses.index');
    }

    public function edit(ConsultationStatus $consultationStatus)
    {
        abort_if(Gate::denies('consultation_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultationStatuses.edit', compact('consultationStatus'));
    }

    public function update(UpdateConsultationStatusRequest $request, ConsultationStatus $consultationStatus)
    {
        $consultationStatus->update($request->all());

        return redirect()->route('admin.consultation-statuses.index');
    }

    public function show(ConsultationStatus $consultationStatus)
    {
        abort_if(Gate::denies('consultation_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultationStatuses.show', compact('consultationStatus'));
    }

    public function destroy(ConsultationStatus $consultationStatus)
    {
        abort_if(Gate::denies('consultation_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultationStatusRequest $request)
    {
        ConsultationStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
