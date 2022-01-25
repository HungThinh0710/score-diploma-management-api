<?php

namespace App\Http\Requests\API\InQueueTranscript;

use Illuminate\Foundation\Http\FormRequest;

class GetTranscriptByTrxIDRequest extends FormRequest
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
            'trxID' => 'required|string|exists:App\Transcript,trxID',
        ];
    }

    public function messages()
    {
        return [
            'trxID.exists' => 'Transaction ID is not exists.'
        ];
    }
}
