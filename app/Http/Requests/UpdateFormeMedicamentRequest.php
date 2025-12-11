<?php

namespace App\Http\Requests;

use App\FormeMedicament;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateFormeMedicamentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('forme_medicament_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:forme_medicaments,name,' . request()->route('forme_medicament')->id,
            ],
        ];
    }
}
