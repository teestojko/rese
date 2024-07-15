<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $user_id = Auth::id(); // ログインユーザーの id を取得

        // リクエストデータに user_id を追加
        $data = $request->all();
        $data['user_id'] = $user_id;

        Reservation::create($data);

        return view('payment.payment');
    }
}
