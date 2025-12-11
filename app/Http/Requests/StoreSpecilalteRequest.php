<?php

namespace App\Http\Requests;

use App\Specilalte;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSpecilalteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('specilalte_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'min:2',
                'required',
                'unique:specilaltes',
            ],
        ];
    }
}
