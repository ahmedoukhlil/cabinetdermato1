<?php

namespace App\Http\Requests;

use App\RdvStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRdvStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rdv_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:rdv_statuses',
            ],
        ];
    }
}
