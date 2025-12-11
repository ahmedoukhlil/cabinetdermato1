<?php

namespace App\Http\Requests;

use App\RdvStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRdvStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rdv_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rdv_statuses,id',
        ];
    }
}
