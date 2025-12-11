<?php

namespace App\Http\Requests;

use App\PaiementStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPaiementStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paiement_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:paiement_statuses,id',
        ];
    }
}
