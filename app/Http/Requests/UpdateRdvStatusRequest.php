<?php

namespace App\Http\Requests;

use App\RdvStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRdvStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rdv_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:rdv_statuses,name,' . request()->route('rdv_status')->id,
            ],
        ];
    }
}
