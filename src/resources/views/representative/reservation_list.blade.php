@extends('Layouts.app')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Representative/reservation_list.css') }}">
@endsection

@section('content')
    <div class="main">
        <div class="sub">
            <div class="title">
                Reservation List
            </div>
            @php
                $currentDate = \Carbon\Carbon::parse($date ?? now()->toDateString());
                $previousDate = $currentDate->copy()->subDay()->toDateString();
                $nextDate = $currentDate->copy()->addDay()->toDateString();
            @endphp
            <div class="date-navigation">
                <form class="date-form" action="{{ route('shop_representative.attendance.date', ['date' => $previousDate]) }}" method="get">
                    <button class="submit" type="submit">
                        &lt;
                    </button>
                </form>
                <p class="attendance_date">
                    {{ $currentDate->toDateString() }}
                </p>
                <form class="date-form" action="{{ route('shop_representative.attendance.date', ['date' => $nextDate]) }}" method="get">
                    <button class="submit" type="submit">
                        &gt;
                    </button>
                </form>
            </div>
            @if ($reservations->isEmpty())
                <p class="error_title">
                    予約情報がありません
                </p>
            @else
                <table class="table">
                    <tr class="table_tr_top">
                        <th class="table_name">
                            お名前
                        </th>
                        <th class="table_date">
                            日付
                        </th>
                        <th class="table_time">
                            時間
                        </th>
                        <th class="table_number">
                            人数
                        </th>
                    </tr>
                    @foreach ($reservations as $reservation)
                        <tr class="table_tr_detail">
                            <td class="table_name">
                                {{ $reservation->user->name }}
                            </td>
                            <td class="table_date">
                                {{ $reservation->reservation_date }}
                            </td>
                            <td class="table_time">
                                {{ $reservation->reservation_time }}
                            </td>
                            <td class="table_number">
                                {{ $reservation->number_of_people }}名
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $reservations->links('vendor.pagination.bootstrap-4') }}
            @endif
            <div class="dashboard_button_content">
                <a class="dashboard_button" href="{{ route('shop_representative.dashboard')}}">
                    戻る
                </a>
            </div>
        </div>
    </div>
@endsection
