<?php

namespace App\Http\Requests;

use App\Analysi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAnalysiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('analysi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'reference' => [
                'required',
                'unique:analysis',
            ],
        ];
    }
}
