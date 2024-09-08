<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
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
            'image_path' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'prefecture_id' => 'required|exists:prefectures,id',
            'genre_id' => 'required|exists:genres,id',
            'detail' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'image_path.required' => '画像を選択してください。',
            'image_path.image' => 'アップロードされたファイルは画像である必要があります。',
            'image_path.max' => '画像ファイルは2MB以下にしてください。',
            'name.required' => '店舗名は必須です。',
            'name.string' => '店舗名は文字列である必要があります。',
            'name.max' => '店舗名は255文字以内で入力してください。',
            'prefecture_id.required' => '都道府県を選択してください。',
            'prefecture_id.exists' => '選択された都道府県は無効です。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'genre_id.exists' => '選択されたジャンルは無効です。',
            'detail.required' => '詳細は必須です。',
            'detail.string' => '詳細は文字列である必要があります。',
            'detail.max' => '詳細は1000文字以内で入力してください。',
        ];
    }
}
