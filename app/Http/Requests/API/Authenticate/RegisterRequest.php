<?php

namespace App\Http\Requests\API\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
//            'org_id' => 'required|integer',
            'email' => 'required|string|max:50|unique:users',
            'full_name' => 'required|string|max:200',
            'password' => 'required|string|max:255'
        ];
    }

    public function messages() //Optional for custom response validate message
    {
        return [
            'org_id.required' => 'Organization is required.',
            'org_id.integer' => 'Organization is not valid.',
            'email.required' => 'Email is required.',
            'email.string'  => 'Email must be a string',
            'email.max' => 'Email max lenght is 50.',
            'email.unique' => 'Email is already exist.',
            'full_name.required' => 'Full name is required.',
            'full_name.string'  => 'Full name must be a string',
        ];
    }
}
