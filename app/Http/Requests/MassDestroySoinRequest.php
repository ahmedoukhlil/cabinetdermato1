<?php

namespace App\Http\Requests;

use App\Soin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySoinRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('soin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:soins,id',
        ];
    }
}
