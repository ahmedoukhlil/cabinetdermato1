<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdonnanceDetailRequest;
use App\Http\Requests\UpdateOrdonnanceDetailRequest;
use App\Http\Resources\Admin\OrdonnanceDetailResource;
use App\OrdonnanceDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdonnanceDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ordonnance_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdonnanceDetailResource(OrdonnanceDetail::with(['forme', 'ordonnance'])->get());
    }

    public function store(StoreOrdonnanceDetailRequest $request)
    {
        $ordonnanceDetail = OrdonnanceDetail::create($request->all());

        return (new OrdonnanceDetailResource($ordonnanceDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrdonnanceDetail $ordonnanceDetail)
    {
        abort_if(Gate::denies('ordonnance_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdonnanceDetailResource($ordonnanceDetail->load(['forme', 'ordonnance']));
    }

    public function update(UpdateOrdonnanceDetailRequest $request, OrdonnanceDetail $ordonnanceDetail)
    {
        $ordonnanceDetail->update($request->all());

        return (new OrdonnanceDetailResource($ordonnanceDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrdonnanceDetail $ordonnanceDetail)
    {
        abort_if(Gate::denies('ordonnance_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordonnanceDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
