<?php

namespace App\Http\Requests;

use App\Paiement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPaiementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paiement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:paiements,id',
        ];
    }
}
