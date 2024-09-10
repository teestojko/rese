<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Mail\ReservationReminder;


class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '送信リマインダーの予約';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $today = Carbon::today();

        $reservations = Reservation::whereDate('reservation_date', $today->toDateString())
            ->whereBetween('reservation_time', ['17:00:00', '23:30:00'])
            ->get();

        foreach ($reservations as $reservation) {
            $reminderDateTime = Carbon::create($reservation->reservation_date)->setTime(9, 0);
                if ($now->greaterThanOrEqualTo($reminderDateTime)) {
                    Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
                    Log::info('Reservation reminder sent to: ' . $reservation->user->email . ' for reservation on ' . $reservation->reservation_date);
                } else {
                    Log::info('Reservation reminder scheduled for: ' . $reservation->user->email . ' on ' . $reminderDateTime);
                }
        }
        $this->info('リマインダーが送信されました。');
    }
}
