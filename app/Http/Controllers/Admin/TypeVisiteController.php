<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTypeVisiteRequest;
use App\Http\Requests\StoreTypeVisiteRequest;
use App\Http\Requests\UpdateTypeVisiteRequest;
use App\TypeVisite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeVisiteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_visite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeVisites = TypeVisite::all();

        return view('admin.typeVisites.index', compact('typeVisites'));
    }

    public function create()
    {
        abort_if(Gate::denies('type_visite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeVisites.create');
    }

    public function store(StoreTypeVisiteRequest $request)
    {
        $typeVisite = TypeVisite::create($request->all());

        return redirect()->route('admin.type-visites.index');
    }

    public function edit(TypeVisite $typeVisite)
    {
        abort_if(Gate::denies('type_visite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeVisites.edit', compact('typeVisite'));
    }

    public function update(UpdateTypeVisiteRequest $request, TypeVisite $typeVisite)
    {
        $typeVisite->update($request->all());

        return redirect()->route('admin.type-visites.index');
    }

    public function show(TypeVisite $typeVisite)
    {
        abort_if(Gate::denies('type_visite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeVisites.show', compact('typeVisite'));
    }

    public function destroy(TypeVisite $typeVisite)
    {
        abort_if(Gate::denies('type_visite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeVisite->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeVisiteRequest $request)
    {
        TypeVisite::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
