<?php

namespace App\Http\Requests\API\Transcript;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranscriptRequest extends FormRequest
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
            'student_code' => 'required|string|exists:App\Transcript,student_code',
            'student_name'  => 'required|string',
            'transcript'   => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'student_code.exists' => 'StudentID is not exists.',
        ];
    }
}
