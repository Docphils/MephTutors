<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EarnedPaymentEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $closedLesson;
    public function __construct($declinedLesson)
    {
        //
        $this->closedLesson = $declinedLesson;
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Closed Lesson and Earned Payment Notification',
            from: 'no-reply@mephed.ng'
        );
    }

   
    public function content(): Content
    {
        return new Content(
            view: 'emails.earned-payment',
            with: ['closedLesson' => $this->closedLesson]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
