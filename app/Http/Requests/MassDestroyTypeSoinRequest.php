<?php

namespace App\Http\Requests;

use App\TypeSoin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTypeSoinRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_soin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:typeSoins,id',
        ];
    }
}
