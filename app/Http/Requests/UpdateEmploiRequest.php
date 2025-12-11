<?php

namespace App\Http\Requests;

use App\Emploi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmploiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('emploi_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:emplois,name,' . request()->route('emploi')->id,
            ],
        ];
    }
}
