<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEmailRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名は必須です。',
            'subject.string' => '件名は文字列である必要があります。',
            'subject.max' => '件名は255文字以内である必要があります。',
            'message.required' => 'メッセージは必須です。',
            'message.string' => 'メッセージは文字列である必要があります。',
        ];
    }
}
