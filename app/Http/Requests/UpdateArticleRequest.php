<?php

namespace App\Http\Requests;

use App\Article;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateArticleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_id'    => [
                'required',
                'integer',
            ],
            'quantity'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prix_aquisition' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prix'            => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'seuil'           => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
