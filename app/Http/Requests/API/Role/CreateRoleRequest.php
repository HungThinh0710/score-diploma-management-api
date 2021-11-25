<?php

namespace App\Http\Requests\API\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => 'required|unique:roles'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Role name has already been taken.'
        ];
    }
}
