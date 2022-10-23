<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
            "key" => Rule::in(['overtime_method']),
            "value" => Rule::exists('references', 'id')->where('code', 'overtime_method'),
        ];
    }

    public function messages()
    {
        return [
            "key.in" => "The name must be filled only with `overtime_method`.",
            "value.exists" => "The value must be filled with references.id with code = `overtime_method`",
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "status_code" => 404,
            "message" => "Validation errors",
            "data" => $validator->errors()
        ]));
    }
}
