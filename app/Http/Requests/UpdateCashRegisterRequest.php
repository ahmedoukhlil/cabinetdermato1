<?php

namespace App\Http\Requests;

use App\CashRegister;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCashRegisterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cash_register_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:cash_registers,name,' . request()->route('cash_register')->id,
            ],
        ];
    }
}
