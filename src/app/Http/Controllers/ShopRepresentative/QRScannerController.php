<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRScannerController extends Controller
{
    public function generateQRCode($reservationId)
    {
        $url = route('shop_representative.reservations_list', ['id' => $reservationId]);
        $qrCode = QrCode::size(300)->generate($url);

        return view('qr_scan', compact('qrCode'));
    }
}
