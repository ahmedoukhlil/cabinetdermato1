<?php

namespace App\Http\Requests;

use App\PaiementDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePaiementDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paiement_details_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'montant' => [
                'required',
                'integer',
                'min:0',
                'max:2000000',
            ],
        ];
    }
}
