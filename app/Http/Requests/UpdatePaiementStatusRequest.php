<?php

namespace App\Http\Requests;

use App\PaiementStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePaiementStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paiement_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:paiement_statuses,name,' . request()->route('paiement_status')->id,
            ],
        ];
    }
}
