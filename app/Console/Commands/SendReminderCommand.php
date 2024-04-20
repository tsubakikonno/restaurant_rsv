<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class SendReminderCommand extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send reminder for upcoming reservations';

    public function handle()
    {
        // 予約情報を取得（例: 当日の予約）
        $reservations = Reservation::whereDate('reservation_date', now())->get();

        // 予約情報をループしてリマインダーメッセージを送信
        foreach ($reservations as $reservation) {
            // リマインダーメッセージの送信処理
            $message = "Dear {$reservation->user->name},\n\n"
                . "本日、予約が入っております。\n\n"
                . "店舗名: {$reservation->restaurant->name}\n"
                . "予約日: {$reservation->reservation_date}\n"
                . "予約日時: {$reservation->reservation_time}\n\n"
                . "変更がある場合、マイページにて変更お願いします。\n\n"
                . "ご来店心よりお待ちしております。";

            $this->line($message);
        }

        $this->info('Reminder messages sent successfully.');
    }
}
