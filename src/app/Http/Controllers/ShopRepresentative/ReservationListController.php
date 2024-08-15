<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class ReservationListController extends Controller
{
    public function reservationList()
    {
        $shop_representative = Auth::guard('shop_representative')->user();

        $shop_id = $shop_representative->shop_id;

        $reservations = Reservation::where('shop_id', $shop_id)->with('user')->paginate(5);

        return view('representative.reservation_list', compact('reservations'));
    }
}
