<?php

namespace App\Http\Requests;

use App\TypeVisite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTypeVisiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_visite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:type_visites,id',
        ];
    }
}
