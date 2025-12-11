<?php

namespace App\Http\Requests;

use App\FactureStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreFactureStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('facture_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:facture_statuses',
            ],
        ];
    }
}
