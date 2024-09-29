<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AfterNow;

class ReservationEditRequest extends FormRequest
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
            'reservation_date' => ['required', 'date', new AfterNow],
            'reservation_time' => ['required', 'date_format:H:i', new AfterNow],
            'number_of_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_date.after_or_equal' => '予約日は今日以降の日付を選択してください。',
            'reservation_time.required' => '予約時間を選択してください。',
            'reservation_time.date_format' => '時間は「時:分」の形式で入力してください。',
            'number_of_people.required' => '人数を入力してください。',
            'number_of_people.integer' => '人数は整数で入力してください。',
            'number_of_people.min' => '人数は1人以上で入力してください。',
        ];
    }
}
