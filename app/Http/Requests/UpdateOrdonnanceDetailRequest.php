<?php

namespace App\Http\Requests;

use App\OrdonnanceDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrdonnanceDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ordonnance_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'forme_id'    => [
                'required',
                'integer',
            ],
            'posologie'     => [
                'required',
            ],
            'quantity'      => [
                'nullable',
                'integer',
                'min:0',
                'max:2147483647',
            ],
            'duration'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ordonnance_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
