<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignTicketFormValidation extends FormRequest
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
            'user_id' => 'required',
            'mail_cc' => 'email',
        ];
    }

    public function messages()
    {
        $messages = [
            'department_id.required' => 'The query type field is required.',
            'user_id.required' => 'The assign to field is required.',
            'mail_cc.email' => 'Email is not valid.',
        ];

        return $messages;
    }
}
