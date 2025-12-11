<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecilalteRequest;
use App\Http\Requests\UpdateSpecilalteRequest;
use App\Http\Resources\Admin\SpecilalteResource;
use App\Specilalte;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecilalteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('specilalte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecilalteResource(Specilalte::all());
    }

    public function store(StoreSpecilalteRequest $request)
    {
        $specilalte = Specilalte::create($request->all());

        return (new SpecilalteResource($specilalte))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Specilalte $specilalte)
    {
        abort_if(Gate::denies('specilalte_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecilalteResource($specilalte);
    }

    public function update(UpdateSpecilalteRequest $request, Specilalte $specilalte)
    {
        $specilalte->update($request->all());

        return (new SpecilalteResource($specilalte))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Specilalte $specilalte)
    {
        abort_if(Gate::denies('specilalte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specilalte->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
