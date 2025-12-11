<?php

namespace App\Http\Requests;

use App\Facture;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateFactureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('facture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'type_facture' => [
                'required',
            ],
        ];
    }
}
