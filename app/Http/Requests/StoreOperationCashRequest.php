<?php

namespace App\Http\Requests;

use App\OperationCash;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOperationCashRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('operation_cash_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'caisse_id'  => [
                'required',
                'integer',
            ],
            'medecin_id' => [
                'required',
                'integer',
            ],
            'montant'    => [
                'required',
            ],
        ];
    }
}
