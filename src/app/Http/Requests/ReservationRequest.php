<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
