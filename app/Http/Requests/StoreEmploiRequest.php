<?php

namespace App\Http\Requests;

use App\Emploi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmploiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('emploi_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:emplois',
            ],
        ];
    }
}
