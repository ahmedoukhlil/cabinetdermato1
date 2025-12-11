<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ConsultationPrice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationPriceRequest;
use App\Http\Requests\UpdateConsultationPriceRequest;
use App\Http\Resources\Admin\ConsultationPriceResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsultationPriceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('consultation_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConsultationPriceResource(ConsultationPrice::with(['type', 'medecin', 'user'])->get());
    }

    public function store(StoreConsultationPriceRequest $request)
    {
        $consultationPrice = ConsultationPrice::create($request->all());

        return (new ConsultationPriceResource($consultationPrice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ConsultationPrice $consultationPrice)
    {
        abort_if(Gate::denies('consultation_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConsultationPriceResource($consultationPrice->load(['type', 'medecin', 'user']));
    }

    public function update(UpdateConsultationPriceRequest $request, ConsultationPrice $consultationPrice)
    {
        $consultationPrice->update($request->all());

        return (new ConsultationPriceResource($consultationPrice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ConsultationPrice $consultationPrice)
    {
        abort_if(Gate::denies('consultation_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationPrice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
