<?php

namespace App\Http\Requests;

use App\ConsultationPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConsultationPriceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'type_id'    => [
                'required',
                'integer',
            ],
            'medecin_id' => [
                'required',
                'integer',
            ],
            'tarif'      => [
                'required',
                'integer',
                'min:0',
                'max:2147483647',
            ],
        ];
    }
}
