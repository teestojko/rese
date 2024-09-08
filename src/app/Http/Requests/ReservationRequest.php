<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AfterNow;

class ReservationRequest extends FormRequest
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
            'reservation_date' => ['required', 'date', new AfterNow],
            'reservation_time' => ['required', 'date_format:H:i', new AfterNow],
            'number_of_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付選択は必須です。',
            'reservation_time.required' => '予約時間選択は必須です。',
            'number_of_people.required' => '人数選択は必須です。',
            'number_of_people.integer' => '人数は数値で入力してください。',
            'number_of_people.min' => '人数は１名以上で入力してください',
        ];
    }
}
