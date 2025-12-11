<?php

namespace App\Http\Requests;

use App\ConsultationStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConsultationStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:consultation_statuses',
            ],
        ];
    }
}
