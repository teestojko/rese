<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'comment' => 'required|string|max:400',
            'image_path' => 'nullable|image|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'コメントは必須です。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは400文字以内である必要があります。',
            'image_path.image' => 'アップロードされたファイルは画像である必要があります。',
            'image_path.mimes' => '画像はjpegまたはpng形式でアップロードしてください。',
            'image_path.max' => '画像ファイルは2MB以下にしてください。',
        ];
    }
}
