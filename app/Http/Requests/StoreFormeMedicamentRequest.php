<?php

namespace App\Http\Requests;

use App\FormeMedicament;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreFormeMedicamentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('forme_medicament_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:forme_medicaments',
            ],
        ];
    }
}
