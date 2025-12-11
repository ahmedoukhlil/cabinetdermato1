<?php

namespace App\Http\Requests;

use App\CommandePaiement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCommandePaiementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commande_paiement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'fournisseur_id'    => [
                'required',
                'integer',
            ],
            'montant'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
