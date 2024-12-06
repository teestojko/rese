<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluationRequest extends FormRequest
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
            'stars' => 'required|integer',
            'comment' => 'required|string|max:400',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'stars.required' => '星評価は必須です。',
            'stars.integer' => '星評価は数値で指定してください。',
            'comment.required' => 'コメントは必須です。',
            'comment.string' => 'コメントは文字列で入力してください。',
            'comment.max' => 'コメントは400文字以内で入力してください。',
            'image.image' => 'アップロードされたファイルは画像である必要があります。',
            'image.max' => '画像ファイルは2MB以下である必要があります。',
        ];
    }
}
