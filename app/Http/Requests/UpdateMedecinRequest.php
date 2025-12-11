<?php

namespace App\Http\Requests;

use App\Medecin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateMedecinRequest extends FormRequest {

    public function authorize() {
        abort_if(Gate::denies('medecin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules() {
        return [
            'grade_id' => [
                'required',
                'integer',
            ],
            'specialite_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'required',
            ],
            'phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone_2' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'free_days' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'daily_consultation' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'daily_rdv' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'consultation_duration' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }

}
