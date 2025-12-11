<?php

namespace App\Http\Requests;

use App\Paiement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePaiementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paiement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'montant' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
