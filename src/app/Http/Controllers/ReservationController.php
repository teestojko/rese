<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $user_id = Auth::id();
        $data = $request->all();
        $data['user_id'] = $user_id;

        $reservation = Reservation::create($data);

        return redirect()->route('payment.thanks',['reservationId' => $reservation->id]);
    }

    public function generateQRCode($reservationId)
    {
        $url = route('shop_representative.reservations_list', ['id' => $reservationId]);
        $qrCode = QrCode::size(300)->generate($url);

        return view('payment.payment_thanks', compact('qrCode'));
    }

    // public function showThanksPage()
    // {
    //     return view('payment.payment_thanks');
    // }

    public function edit($id)
{
    $reservation = Reservation::findOrFail($id);
    return view('edit', compact('reservation'));
}

public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->update($request->all());
    return redirect()->route('shops.show', $reservation->shop_id)->with('success', 'Reservation updated successfully.');
}


}
