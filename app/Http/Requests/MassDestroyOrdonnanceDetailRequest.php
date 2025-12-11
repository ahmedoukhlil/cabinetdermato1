<?php

namespace App\Http\Requests;

use App\OrdonnanceDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrdonnanceDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ordonnance_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ordonnance_details,id',
        ];
    }
}
