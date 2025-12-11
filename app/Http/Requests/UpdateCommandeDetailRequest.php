<?php

namespace App\Http\Requests;

use App\CommandeDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCommandeDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commande_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'article_id'    => [
                'required',
                'integer',
            ],
            'quantity'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prix_unitaire' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'commande_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
