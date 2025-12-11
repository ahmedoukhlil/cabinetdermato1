<?php

namespace App\Http\Requests;

use App\AppointmentCanal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAppointmentCanalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_prise_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:type_prises,id',
        ];
    }
}
