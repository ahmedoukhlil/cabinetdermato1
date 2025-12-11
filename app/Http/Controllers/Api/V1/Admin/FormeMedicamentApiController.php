<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\FormeMedicament;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormeMedicamentRequest;
use App\Http\Requests\UpdateFormeMedicamentRequest;
use App\Http\Resources\Admin\FormeMedicamentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormeMedicamentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('forme_medicament_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormeMedicamentResource(FormeMedicament::all());
    }

    public function store(StoreFormeMedicamentRequest $request)
    {
        $formeMedicament = FormeMedicament::create($request->all());

        return (new FormeMedicamentResource($formeMedicament))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FormeMedicament $formeMedicament)
    {
        abort_if(Gate::denies('forme_medicament_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormeMedicamentResource($formeMedicament);
    }

    public function update(UpdateFormeMedicamentRequest $request, FormeMedicament $formeMedicament)
    {
        $formeMedicament->update($request->all());

        return (new FormeMedicamentResource($formeMedicament))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FormeMedicament $formeMedicament)
    {
        abort_if(Gate::denies('forme_medicament_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formeMedicament->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
