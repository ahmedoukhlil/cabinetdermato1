<?php

namespace App\Http\Requests;

use App\ConsultationStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateConsultationStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:consultation_statuses,name,' . request()->route('consultation_status')->id,
            ],
        ];
    }
}
