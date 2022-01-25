<?php

namespace App\Http\Requests\API\Transcript;

use Illuminate\Foundation\Http\FormRequest;

class SubmitNewTranscriptRequest extends FormRequest
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
            'class_id'     => 'required|integer|exists:App\ClassRoom,id',
            'student_code'    => 'required|string',
            'student_name'  => 'required|string',
            'transcript' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'class_id.exists' => 'Class is not exists.',
//            'class_id.required' => 'Class id is required',
//            'class_id.integer' => 'Class id must be a number',
        ];
    }
}
