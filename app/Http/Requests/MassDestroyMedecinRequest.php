<?php

namespace App\Http\Requests;

use App\Medecin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMedecinRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('medecin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:medecins,id',
        ];
    }
}
