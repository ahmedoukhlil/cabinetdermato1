<?php

namespace App\Http\Requests;

use App\Ordonnance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrdonnanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ordonnance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ordonnances,id',
        ];
    }
}
