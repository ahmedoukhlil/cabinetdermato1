<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeSoinRequest;
use App\Http\Requests\UpdateTypeSoinRequest;
use App\Http\Resources\Admin\TypeSoinResource;
use App\TypeSoin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeSoinsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_soin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeSoinResource(TypeSoin::with(['caisse'])->get());
    }

    public function store(StoreTypeSoinRequest $request)
    {
        $typeSoin = TypeSoin::create($request->all());

        return (new TypeSoinResource($typeSoin))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeSoin $typeSoin)
    {
        abort_if(Gate::denies('type_soin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeSoinResource($typeSoin->load(['caisse']));
    }

    public function update(UpdateTypeSoinRequest $request, TypeSoin $typeSoin)
    {
        $typeSoin->update($request->all());

        return (new TypeSoinResource($typeSoin))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeSoin $typeSoin)
    {
        abort_if(Gate::denies('type_soin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeSoin->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
