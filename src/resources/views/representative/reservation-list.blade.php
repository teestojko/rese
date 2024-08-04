@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reservation-list.css') }}">
@endsection

@section('content')
    <h1>Reservation List</h1>

    @if ($reservations->isEmpty())
        <p>No reservations found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of People</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
