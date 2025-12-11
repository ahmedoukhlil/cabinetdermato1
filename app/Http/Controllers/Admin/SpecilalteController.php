<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpecilalteRequest;
use App\Http\Requests\StoreSpecilalteRequest;
use App\Http\Requests\UpdateSpecilalteRequest;
use App\Specilalte;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecilalteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('specilalte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specilaltes = Specilalte::all();

        return view('admin.specilaltes.index', compact('specilaltes'));
    }

    public function create()
    {
        abort_if(Gate::denies('specilalte_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specilaltes.create');
    }

    public function store(StoreSpecilalteRequest $request)
    {
        $specilalte = Specilalte::create($request->all());

        return redirect()->route('admin.specilaltes.index');
    }

    public function edit(Specilalte $specilalte)
    {
        abort_if(Gate::denies('specilalte_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specilaltes.edit', compact('specilalte'));
    }

    public function update(UpdateSpecilalteRequest $request, Specilalte $specilalte)
    {
        $specilalte->update($request->all());

        return redirect()->route('admin.specilaltes.index');
    }

    public function show(Specilalte $specilalte)
    {
        abort_if(Gate::denies('specilalte_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specilaltes.show', compact('specilalte'));
    }

    public function destroy(Specilalte $specilalte)
    {
        abort_if(Gate::denies('specilalte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specilalte->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecilalteRequest $request)
    {
        Specilalte::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
