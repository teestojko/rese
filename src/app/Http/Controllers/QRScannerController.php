<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class QRScannerController extends Controller
{
    public function generateQRCode($reservationId)
    {
        $qrCode = QrCode::size(300)->generate(route('show_check_in', ['reservationId' => $reservationId]));
        return view('qr_scan', compact('qrCode'));
    }

    public function showCheckInPage($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', '予約が見つかりませんでした。');
        }
        return view('check_in', compact('reservation'));
    }

    public function confirmCheckIn(Request $request, $reservationId)
    {
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', '予約が見つかりませんでした。');
        }
        // 予約のチェックインを更新
        $reservation->checked_in = true;
        $reservation->save();
        return redirect()->back()->with('success', 'チェックインが確認されました。');
    }
}
