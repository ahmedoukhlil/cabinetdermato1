<?php

namespace App\Http\Requests;

use App\MotifCharge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMotifChargeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('motif_charge_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:motif_charges,name,' . request()->route('motif_charge')->id,
            ],
        ];
    }
}
