<!DOCTYPE html>
<html>
    <head>
        <title>予約リマインダー</title>
    </head>
    <body>
        <p class="reservation_reminder">
            {{ $reservation->user->name }}様
        </p>
        <p class="reservation_reminder_title">
            以下の予約が本日予定されています：
        </p>
        <p class="reservation_reminder_shop_name">
            店舗名: {{ $reservation->shop->name }}
        </p>
        <p class="reservation_reminder_time">
            予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}
        </p>
        <p class="reservation_reminder_number">
            人数: {{ $reservation->number_of_people }}人
        </p>
        <p class="reservation_reminder_thanks">
            ご来店をお待ちしております。
        </p>
    </body>
</html>
