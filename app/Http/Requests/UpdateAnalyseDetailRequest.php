<?php

namespace App\Http\Requests;

use App\AnalyseDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAnalyseDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('analyse_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'analyse_id' => [
                'required',
                'integer',
            ],
            'name'       => [
                'required',
            ],
        ];
    }
}
