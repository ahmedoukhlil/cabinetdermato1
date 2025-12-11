<?php

namespace App\Http\Requests;

use App\TypeConsultation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTypeConsultationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:type_consultations',
            ],
        ];
    }
}
