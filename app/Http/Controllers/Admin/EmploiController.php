<?php

namespace App\Http\Controllers\Admin;

use App\Emploi;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmploiRequest;
use App\Http\Requests\StoreEmploiRequest;
use App\Http\Requests\UpdateEmploiRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmploiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('emploi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emplois = Emploi::all();

        return view('admin.emplois.index', compact('emplois'));
    }

    public function create()
    {
        abort_if(Gate::denies('emploi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emplois.create');
    }

    public function store(StoreEmploiRequest $request)
    {
        $emploi = Emploi::create($request->all());

        return redirect()->route('admin.emplois.index');
    }

    public function edit(Emploi $emploi)
    {
        abort_if(Gate::denies('emploi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emplois.edit', compact('emploi'));
    }

    public function update(UpdateEmploiRequest $request, Emploi $emploi)
    {
        $emploi->update($request->all());

        return redirect()->route('admin.emplois.index');
    }

    public function show(Emploi $emploi)
    {
        abort_if(Gate::denies('emploi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emploi->load('emploiEmployees');

        return view('admin.emplois.show', compact('emploi'));
    }

    public function destroy(Emploi $emploi)
    {
        abort_if(Gate::denies('emploi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emploi->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmploiRequest $request)
    {
        Emploi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
