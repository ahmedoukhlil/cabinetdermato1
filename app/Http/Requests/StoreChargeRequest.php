<?php

namespace App\Http\Requests;

use App\Charge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChargeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('charge_create');
    }

    public function rules()
    {
        return [
            'dt_charge' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'motif_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
