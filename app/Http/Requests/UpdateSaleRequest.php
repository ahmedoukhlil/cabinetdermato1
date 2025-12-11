<?php

namespace App\Http\Requests;

use App\Sale;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSaleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
