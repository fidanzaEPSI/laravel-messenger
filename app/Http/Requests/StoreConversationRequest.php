<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversationRequest extends FormRequest
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
            'body' => 'required|max:500',
            'recipients' => 'required|array|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'You must write a message!',
            'recipients.required' => 'You must pick up atleast one person'
        ];
    }
}
