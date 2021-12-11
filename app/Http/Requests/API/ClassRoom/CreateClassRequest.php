<?php

namespace App\Http\Requests\API\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
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
            'class_name' => 'required|string',
            'major_id'   => 'required|exists:App\Major,id',
            'start_year' => 'required|numeric|min:1965',
            'code' => 'required|string',
        ];
    }

    public function messages() //Optional for custom response validate message
    {
        return [
            'class_name.required' => 'class_name id is required.',
            'class_name.string' => 'org_id is not valid.',
            'start_year.required' => 'start_year is required.',
            'start_year.numeric' => 'start_year is not valid.',
            'code.required' => 'code is required.',
            'code.string' => 'code is not valid.',
        ];
    }
}
