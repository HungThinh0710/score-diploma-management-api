<?php

namespace App\Http\Requests\API\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
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
            'class_id' => 'required|integer',
        ];
    }

    public function messages() //Optional for custom response validate message
    {
        return [
            'class_id.required' => 'class_id id is required.',
            'class_id.integer' => 'class_id id is required.',
        ];
    }
}
