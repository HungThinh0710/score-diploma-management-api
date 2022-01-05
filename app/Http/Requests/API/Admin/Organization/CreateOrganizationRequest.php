<?php

namespace App\Http\Requests\API\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizationRequest extends FormRequest
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
            "admin_user"     => "required|string|email",
            "admin_password" => "required|string|min:6",
            "org_name"       => "required|string",
            "org_code"       => "required|string",
            "email"          => "required",
            "domain"         => "required|string",
            "address"        => "required|string",

        ];
    }
}
