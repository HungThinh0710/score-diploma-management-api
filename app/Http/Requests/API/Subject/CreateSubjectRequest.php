<?php

namespace App\Http\Requests\API\Subject;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectRequest extends FormRequest
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
            "subject_name" => "required|string",
            "subject_code" => "required|string",
            "credit"       => "required|numeric|min:0",
        ];
    }
}
