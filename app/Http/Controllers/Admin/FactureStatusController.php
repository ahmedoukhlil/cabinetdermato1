<?php

namespace App\Http\Controllers\Admin;

use App\FactureStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFactureStatusRequest;
use App\Http\Requests\StoreFactureStatusRequest;
use App\Http\Requests\UpdateFactureStatusRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FactureStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facture_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $factureStatuses = FactureStatus::all();

        return view('admin.factureStatuses.index', compact('factureStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('facture_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.factureStatuses.create');
    }

    public function store(StoreFactureStatusRequest $request)
    {
        $factureStatus = FactureStatus::create($request->all());

        return redirect()->route('admin.facture-statuses.index');
    }

    public function edit(FactureStatus $factureStatus)
    {
        abort_if(Gate::denies('facture_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.factureStatuses.edit', compact('factureStatus'));
    }

    public function update(UpdateFactureStatusRequest $request, FactureStatus $factureStatus)
    {
        $factureStatus->update($request->all());

        return redirect()->route('admin.facture-statuses.index');
    }

    public function show(FactureStatus $factureStatus)
    {
        abort_if(Gate::denies('facture_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.factureStatuses.show', compact('factureStatus'));
    }

    public function destroy(FactureStatus $factureStatus)
    {
        abort_if(Gate::denies('facture_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $factureStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyFactureStatusRequest $request)
    {
        FactureStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
