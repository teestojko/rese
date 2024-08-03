<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopCreateEditRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image_path' => 'required|string|max:255',
            'prefecture' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'detail' => 'required|string',
        ];
    }
}
