<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRdvStatusRequest;
use App\Http\Requests\UpdateRdvStatusRequest;
use App\Http\Resources\Admin\RdvStatusResource;
use App\RdvStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RdvStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rdv_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RdvStatusResource(RdvStatus::all());
    }

    public function store(StoreRdvStatusRequest $request)
    {
        $rdvStatus = RdvStatus::create($request->all());

        return (new RdvStatusResource($rdvStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RdvStatus $rdvStatus)
    {
        abort_if(Gate::denies('rdv_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RdvStatusResource($rdvStatus);
    }

    public function update(UpdateRdvStatusRequest $request, RdvStatus $rdvStatus)
    {
        $rdvStatus->update($request->all());

        return (new RdvStatusResource($rdvStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RdvStatus $rdvStatus)
    {
        abort_if(Gate::denies('rdv_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rdvStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
