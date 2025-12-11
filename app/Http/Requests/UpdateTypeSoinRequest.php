<?php

namespace App\Http\Requests;

use App\TypeSoin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTypeSoinRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_soin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'      => [
                'required',
                'unique:type_soins,name,' . request()->route('type_soin')->id,
            ],
            'prix'      => [
                'required',
            ],
            'caisse_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
