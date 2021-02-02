<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictFormValidation extends FormRequest
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
            'name' => 'required',
            'division_id' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'The district field is required.',
            'division_id.required' => 'The Division Field is required'
        ];

        return $messages;
    }
}
