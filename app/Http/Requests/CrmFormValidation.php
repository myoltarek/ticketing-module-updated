<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmFormValidation extends FormRequest
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
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'agent_name' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'query_type_id' => 'required',
            'department_id' => 'required',
            'complain_type_id' => 'required',
            'call_remark_id' => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'customer_name.required' => 'The Customer Name Field is required.',
            'customer_contact.required' => 'The Customer Contact is required',
            'agent_name.required' => 'The Agent Name is required',
            'district_id.required' => 'The District Field is required',
            'address.required' => 'The Address Field is required',
            'profession.required' => 'The Profession Field is required',
            'query_type_id.required' => 'The Query Field is required',
            'department_id.required' => 'The Department Field is required',
            'complain_type_id.required' => 'The Complain Field is required',
            'call_remark_id.required' => 'The Call Remark Field is required'
        ];

        return $messages;
    }
}
