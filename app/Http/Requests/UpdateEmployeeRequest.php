<?php

namespace App\Http\Requests;

use App\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_edit');
    }

    public function rules()
    {
        return [
            'matricule' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:employees,matricule,' . request()->route('employee')->id,
            ],
            'nni' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:employees,nni,' . request()->route('employee')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'salary' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'photo' => [
                'required',
            ],
            'recruitement_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'emploi_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
