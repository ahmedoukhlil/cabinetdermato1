<?php

namespace App\Http\Requests;

use App\Commande;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCommandeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commande_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
