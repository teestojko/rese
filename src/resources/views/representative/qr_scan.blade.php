{{-- @extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/representative/qr_scan.css') }}">
@endsection
@section('script')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // スキャン成功時の処理
            console.log(`Code matched = ${decodedText}`);
            // ここでサーバーに照合リクエストを送ることができます
            // 例: fetch('/reservation/verify', { method: 'POST', body: JSON.stringify({ code: decodedText }) });
        }

        function onScanError(errorMessage) {
            // エラー処理
            console.log(`QR Code scan error = ${errorMessage}`);
        }

        const html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
    </script>
@endsection
@section('content')
<div id="reader">
    <video id="js-video" class="reader-video" autoplay playsinline></video>
</div>
@endsection --}}

<html>
<head>
    <title>QR Code Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/representative/qr_scan.css') }}">
</head>
<body>
<div class="qr_main">
    <div class="title">
        QR Code Scanner
    </div>
    <div class="dashboard_button_content">
        <a class="dashboard_button" href="{{ route('shop_representative.dashboard')}}">
            戻る
        </a>
    </div>
    <div id="interactive" class="viewport"></div>
    <script class="qr" type="text/javascript">
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#interactive'),    // カメラ映像を表示する要素
            },
            decoder: {
                readers: ["qr_reader"]   // QRコードリーダーを指定
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return;
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            console.log("QR Code detected: ", result.codeResult.code);
            // サーバーに照合リクエストを送る処理
        });
    </script>
</div>
</body>
</html>
