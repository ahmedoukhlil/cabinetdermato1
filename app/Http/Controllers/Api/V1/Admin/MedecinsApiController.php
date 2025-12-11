<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Medecin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedecinRequest;
use App\Http\Requests\UpdateMedecinRequest;
use App\Http\Resources\Admin\MedecinResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedecinsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('medecin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedecinResource(Medecin::with(['grade', 'specialite'])->get());
    }

    public function store(StoreMedecinRequest $request)
    {
        $medecin = Medecin::create($request->all());

        return (new MedecinResource($medecin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Medecin $medecin)
    {
        abort_if(Gate::denies('medecin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedecinResource($medecin->load(['grade', 'specialite']));
    }

    public function update(UpdateMedecinRequest $request, Medecin $medecin)
    {
        $medecin->update($request->all());

        return (new MedecinResource($medecin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Medecin $medecin)
    {
        abort_if(Gate::denies('medecin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medecin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
