<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'shop_id' => 'required|exists:shops,id',
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => 'ショップIDは必須です。',
            'shop_id.exists' => '選択されたショップが存在しません。',
            'stars.required' => '評価は必須です。',
            'stars.integer' => '評価は整数である必要があります。',
            'stars.min' => '評価は1以上でなければなりません。',
            'stars.max' => '評価は5以下でなければなりません。',
            'comment.required' => 'コメントは必須です。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは255文字以内である必要があります。',
        ];
    }
}
