<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRdvStatusRequest;
use App\Http\Requests\StoreRdvStatusRequest;
use App\Http\Requests\UpdateRdvStatusRequest;
use App\RdvStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RdvStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rdv_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rdvStatuses = RdvStatus::all();

        return view('admin.rdvStatuses.index', compact('rdvStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('rdv_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rdvStatuses.create');
    }

    public function store(StoreRdvStatusRequest $request)
    {
        $rdvStatus = RdvStatus::create($request->all());

        return redirect()->route('admin.rdv-statuses.index');
    }

    public function edit(RdvStatus $rdvStatus)
    {
        abort_if(Gate::denies('rdv_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rdvStatuses.edit', compact('rdvStatus'));
    }

    public function update(UpdateRdvStatusRequest $request, RdvStatus $rdvStatus)
    {
        $rdvStatus->update($request->all());

        return redirect()->route('admin.rdv-statuses.index');
    }

    public function show(RdvStatus $rdvStatus)
    {
        abort_if(Gate::denies('rdv_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rdvStatuses.show', compact('rdvStatus'));
    }

    public function destroy(RdvStatus $rdvStatus)
    {
        abort_if(Gate::denies('rdv_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rdvStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyRdvStatusRequest $request)
    {
        RdvStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
