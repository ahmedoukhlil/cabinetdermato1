<?php

namespace App\Http\Requests;

use App\AppointmentCanal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAppointmentCanalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('appointment_canal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:appointment_canals,name,' . request()->route('appointment_canal')->id,
            ],
        ];
    }
}
