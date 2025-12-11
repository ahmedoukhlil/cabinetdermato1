<?php

namespace App\Http\Requests;

use App\AnalyseDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAnalyseDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('analyse_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:analyse_details,id',
        ];
    }
}
