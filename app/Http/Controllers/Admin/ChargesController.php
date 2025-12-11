<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChargeRequest;
use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;
use App\MotifCharge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChargesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charges = Charge::with(['motif'])->get();

        return view('admin.charges.index', compact('charges'));
    }

    public function create()
    {
        abort_if(Gate::denies('charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motifs = MotifCharge::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.charges.create', compact('motifs'));
    }

    public function store(StoreChargeRequest $request)
    {
        $charge = Charge::create($request->all());

        return redirect()->route('admin.charges.index');
    }

    public function edit(Charge $charge)
    {
        abort_if(Gate::denies('charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motifs = MotifCharge::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charge->load('motif');

        return view('admin.charges.edit', compact('motifs', 'charge'));
    }

    public function update(UpdateChargeRequest $request, Charge $charge)
    {
        $charge->update($request->all());

        return redirect()->route('admin.charges.index');
    }

    public function show(Charge $charge)
    {
        abort_if(Gate::denies('charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charge->load('motif');

        return view('admin.charges.show', compact('charge'));
    }

    public function destroy(Charge $charge)
    {
        abort_if(Gate::denies('charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charge->delete();

        return back();
    }

    public function massDestroy(MassDestroyChargeRequest $request)
    {
        Charge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
