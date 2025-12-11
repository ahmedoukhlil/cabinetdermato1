<?php

namespace App\Http\Requests;

use App\ConsultationPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConsultationPriceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:consultation_prices,id',
        ];
    }
}
