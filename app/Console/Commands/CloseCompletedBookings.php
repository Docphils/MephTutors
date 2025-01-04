<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Payment;
use App\Mail\EarnedPaymentEmail;
use Illuminate\Support\Facades\Mail;

class CloseCompletedBookings extends Command
{
    protected $signature = 'bookings:close-completed';
    protected $description = 'Close bookings that have been completed for more than 24 hours';

    public function handle()
    {
        $bookings = Booking::where('status', 'Completed')
            ->where('completed_at', '<=', now()->subHours(24))
            ->get();

        foreach ($bookings as $booking) {
            try {
                $booking->update(['status' => 'Closed']);

                $payment = Payment::where('booking_id', $booking->id)->first();
                if ($payment) {
                    $payment->update(['status' => 'Earned']);
                }

                Mail::to('admin@mephed.ng')->send(new EarnedPaymentEmail($booking));

                $this->info("Closed booking ID: {$booking->id}");
            } catch (\Exception $e) {
                $this->error("Error processing booking ID {$booking->id}: " . $e->getMessage());
            }
        }

        $this->info('Completed processing bookings.');
    }
}
