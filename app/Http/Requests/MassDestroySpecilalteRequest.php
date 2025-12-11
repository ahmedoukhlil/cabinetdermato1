<?php

namespace App\Http\Requests;

use App\Specilalte;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySpecilalteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('specilalte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:specilaltes,id',
        ];
    }
}
