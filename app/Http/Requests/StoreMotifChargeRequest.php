<?php

namespace App\Http\Requests;

use App\MotifCharge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMotifChargeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('motif_charge_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:motif_charges',
            ],
        ];
    }
}
