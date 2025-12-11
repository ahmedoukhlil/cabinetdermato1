<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaiementStatusRequest;
use App\Http\Requests\StorePaiementStatusRequest;
use App\Http\Requests\UpdatePaiementStatusRequest;
use App\PaiementStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaiementStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('paiement_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiementStatuses = PaiementStatus::all();

        return view('admin.paiementStatuses.index', compact('paiementStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('paiement_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paiementStatuses.create');
    }

    public function store(StorePaiementStatusRequest $request)
    {
        $paiementStatus = PaiementStatus::create($request->all());

        return redirect()->route('admin.paiement-statuses.index');
    }

    public function edit(PaiementStatus $paiementStatus)
    {
        abort_if(Gate::denies('paiement_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paiementStatuses.edit', compact('paiementStatus'));
    }

    public function update(UpdatePaiementStatusRequest $request, PaiementStatus $paiementStatus)
    {
        $paiementStatus->update($request->all());

        return redirect()->route('admin.paiement-statuses.index');
    }

    public function show(PaiementStatus $paiementStatus)
    {
        abort_if(Gate::denies('paiement_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paiementStatuses.show', compact('paiementStatus'));
    }

    public function destroy(PaiementStatus $paiementStatus)
    {
        abort_if(Gate::denies('paiement_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paiementStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaiementStatusRequest $request)
    {
        PaiementStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
