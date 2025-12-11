<?php

namespace App\Http\Requests;

use App\TypeVisite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTypeVisiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_visite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:type_visites',
            ],
        ];
    }
}
