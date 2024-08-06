<!DOCTYPE html>
<html>
<head>
    <title>予約リマインダー</title>
</head>
<body>
    <p>{{ $reservation->user->name }}様</p>
    <p>以下の予約が本日予定されています：</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
    <p>人数: {{ $reservation->number_of_people }}人</p>
    <p>ご来店をお待ちしております。</p>
</body>
</html>
