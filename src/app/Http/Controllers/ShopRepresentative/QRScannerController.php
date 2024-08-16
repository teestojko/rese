<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QRScannerController extends Controller
{
    public function showScanner()
    {
        return view('representative.qr_scan');
    }
}
