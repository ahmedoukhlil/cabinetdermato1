<?php

namespace App\Http\Requests;

use App\CommandePaiement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCommandePaiementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commande_paiement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'montant'    => [
                'required',
                'integer',
            ],
        ];
    }
}
