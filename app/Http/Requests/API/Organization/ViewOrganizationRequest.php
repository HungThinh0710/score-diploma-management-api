<?php

namespace App\Http\Requests\API\Organization;

use Illuminate\Foundation\Http\FormRequest;

class ViewOrganizationRequest extends FormRequest
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
            'org_id' => 'required|integer',
        ];
    }

    public function messages() //Optional for custom response validate message
    {
        return [
            'org_id.required' => 'org_id id is required.',
            'org_id.integer' => 'org_id is not valid.',
        ];
    }
}
