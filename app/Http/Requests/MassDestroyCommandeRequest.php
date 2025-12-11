<?php

namespace App\Http\Requests;

use App\Commande;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCommandeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commande_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:commandes,id',
        ];
    }
}
