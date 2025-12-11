<?php

namespace App\Http\Requests;

use App\Ordonnance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrdonnanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ordonnance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ordonnance_details'   => [
                'required',
                'array',
            ],
        ];
    }
}
