<?php

namespace App\Http\Requests;

use App\Genre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreGenreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('genre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:genres',
            ],
        ];
    }
}
