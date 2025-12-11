<?php

namespace App\Http\Requests;

use App\ConsultationStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConsultationStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:consultation_statuses,id',
        ];
    }
}
