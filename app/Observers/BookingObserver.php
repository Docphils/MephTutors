<?php

namespace App\Observers;

use App\Models\Booking;

class BookingObserver
{

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        // Update status_changed_at when the status changes to 'Completed'
        if ($booking->isDirty('status') && $booking->status === 'Completed') {
            $booking->update(['completed_at' => now()]);
        }
    }

}
