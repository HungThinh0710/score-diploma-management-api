<?php

namespace App\Http\Requests\API\Major;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMajorRequest extends FormRequest
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
            'major_id' => 'required|exists:App\Major,id',
        ];
    }
}
