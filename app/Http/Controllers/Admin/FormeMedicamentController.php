<?php

namespace App\Http\Controllers\Admin;

use App\FormeMedicament;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFormeMedicamentRequest;
use App\Http\Requests\StoreFormeMedicamentRequest;
use App\Http\Requests\UpdateFormeMedicamentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormeMedicamentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('forme_medicament_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formeMedicaments = FormeMedicament::all();

        return view('admin.formeMedicaments.index', compact('formeMedicaments'));
    }

    public function create()
    {
        abort_if(Gate::denies('forme_medicament_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formeMedicaments.create');
    }

    public function store(StoreFormeMedicamentRequest $request)
    {
        $formeMedicament = FormeMedicament::create($request->all());

        return redirect()->route('admin.forme-medicaments.index');
    }

    public function edit(FormeMedicament $formeMedicament)
    {
        abort_if(Gate::denies('forme_medicament_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formeMedicaments.edit', compact('formeMedicament'));
    }

    public function update(UpdateFormeMedicamentRequest $request, FormeMedicament $formeMedicament)
    {
        $formeMedicament->update($request->all());

        return redirect()->route('admin.forme-medicaments.index');
    }

    public function show(FormeMedicament $formeMedicament)
    {
        abort_if(Gate::denies('forme_medicament_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formeMedicaments.show', compact('formeMedicament'));
    }

    public function destroy(FormeMedicament $formeMedicament)
    {
        abort_if(Gate::denies('forme_medicament_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formeMedicament->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormeMedicamentRequest $request)
    {
        FormeMedicament::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
