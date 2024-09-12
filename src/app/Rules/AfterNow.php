<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class AfterNow implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i');

        if ($attribute === 'reservation_date') {
            return $value >= $currentDate;
        }

        if ($attribute === 'reservation_time') {
            $reservationDate = request()->get('reservation_date');
            if ($reservationDate === $currentDate) {
                return $value >= $currentTime;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '現在以降の日付、時間を選択してください。';
    }
}
