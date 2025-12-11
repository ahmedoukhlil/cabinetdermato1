<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTypeConsultationRequest;
use App\Http\Requests\StoreTypeConsultationRequest;
use App\Http\Requests\UpdateTypeConsultationRequest;
use App\TypeConsultation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeConsultationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_consultation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeConsultations = TypeConsultation::all();

        return view('admin.typeConsultations.index', compact('typeConsultations'));
    }

    public function create()
    {
        abort_if(Gate::denies('type_consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeConsultations.create');
    }

    public function store(StoreTypeConsultationRequest $request)
    {
        $typeConsultation = TypeConsultation::create($request->all());

        return redirect()->route('admin.type-consultations.index');
    }

    public function edit(TypeConsultation $typeConsultation)
    {
        abort_if(Gate::denies('type_consultation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeConsultations.edit', compact('typeConsultation'));
    }

    public function update(UpdateTypeConsultationRequest $request, TypeConsultation $typeConsultation)
    {
        $typeConsultation->update($request->all());

        return redirect()->route('admin.type-consultations.index');
    }

    public function show(TypeConsultation $typeConsultation)
    {
        abort_if(Gate::denies('type_consultation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeConsultation->load('typeConsultationPrices');

        return view('admin.typeConsultations.show', compact('typeConsultation'));
    }

    public function destroy(TypeConsultation $typeConsultation)
    {
        abort_if(Gate::denies('type_consultation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeConsultation->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeConsultationRequest $request)
    {
        TypeConsultation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
