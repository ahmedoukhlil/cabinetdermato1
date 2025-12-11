<?php

namespace App\Http\Requests;

use App\FormeMedicament;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFormeMedicamentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('forme_medicament_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:forme_medicaments,id',
        ];
    }
}
