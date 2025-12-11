<?php

namespace App\Http\Requests;

use App\Consultation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConsultationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'patient_id' => [
                'required',
                'integer',
            ],
            'appointment_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
