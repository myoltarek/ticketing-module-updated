<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EscalationMatrixFormValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' => 'required',
            'escalation_level_id' => 'required',
            'user_id' => 'required',
            'to_or_cc' => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'department_id.required' => 'The Department is required',
            'escalation_level_id.required' => 'The Escalation Level is required',
            'user_id.required' => 'The assign to field is required',
            'to_or_cc.required' => 'This field is required',
        ];

        return $messages;
    }
}
