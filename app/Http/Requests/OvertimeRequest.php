<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OvertimeRequest extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'time_started' =>
                'required|date_format:H:i|before_or_equal:time_ended',
            'time_ended' =>
                'required|date_format:H:i|after_or_equal:time_started',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'The Employee ID can not be blank value.',
            'employee_id.integer' => 'The Employee ID must be integer.',
            'employee_id.exists' =>
                'The Employee ID is not exist in database table employees.',
            'date.required' => 'The date can not be blank value.',
            'date.date' => 'The date must be Date type (YYYY-MM-DD).',
            // 'date.exclude_with' =>
            //     'The date can not be same based on Employee ID.',
            'time_started.required' =>
                'The time started can not be blank value.',
            'time_started.date_format' =>
                'The time started format must be HH:mm.',
            'time_started.before_or_equal' =>
                'The time started can not be after or equal time ended.',
            'time_ended.required' => 'The time ended can not be blank value.',
            'time_ended.date_format' => 'The time ended format must be HH:mm.',
            'time_ended.after_or_equal' =>
                'The time ended can not be before or equal time started.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'status_code' => 404,
                'message' => 'Validation errors',
                'data' => $validator->errors(),
            ])
        );
    }
}
