<?php

namespace App\Http\Requests;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:employees,name',
            'salary' => 'required|integer|min:2000000|max:10000000',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "The name can not be blank value.",
            "name.string" => "The name must be string.",
            "name.min" => "The name contain at least 2 letters.",
            "name:unique" => "The name is already exist.",
            "salary.required" => "The salary can not be blank value.",
            "salary.integer" => "The salary must be integer.",
            "salary.min" => "The salary at least Rp.2000000.",
            "salary.max" => "The salary is out of Rp.10000000."
        ];
    }

    public function failedValidation(ValidationValidator $validator) {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "status_code" => 404,
            "message" => "Validation errors",
            "data" => $validator->errors()
        ]));
    }
}
