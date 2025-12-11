<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMotifChargeRequest;
use App\Http\Requests\StoreMotifChargeRequest;
use App\Http\Requests\UpdateMotifChargeRequest;
use App\MotifCharge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MotifChargesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('motif_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motifCharges = MotifCharge::all();

        return view('admin.motifCharges.index', compact('motifCharges'));
    }

    public function create()
    {
        abort_if(Gate::denies('motif_charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motifCharges.create');
    }

    public function store(StoreMotifChargeRequest $request)
    {
        $motifCharge = MotifCharge::create($request->all());

        return redirect()->route('admin.motif-charges.index');
    }

    public function edit(MotifCharge $motifCharge)
    {
        abort_if(Gate::denies('motif_charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motifCharges.edit', compact('motifCharge'));
    }

    public function update(UpdateMotifChargeRequest $request, MotifCharge $motifCharge)
    {
        $motifCharge->update($request->all());

        return redirect()->route('admin.motif-charges.index');
    }

    public function show(MotifCharge $motifCharge)
    {
        abort_if(Gate::denies('motif_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motifCharge->load('motifCharges');

        return view('admin.motifCharges.show', compact('motifCharge'));
    }

    public function destroy(MotifCharge $motifCharge)
    {
        abort_if(Gate::denies('motif_charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motifCharge->delete();

        return back();
    }

    public function massDestroy(MassDestroyMotifChargeRequest $request)
    {
        MotifCharge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
