<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TutorRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $tutorRequest;
    private $client;
    /**
     * Create a new message instance.
     */
    public function __construct($tutorRequest)
    {
        $this->tutorRequest = $tutorRequest;
        $this->client = $tutorRequest->user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Tutor Request Submission',
            from: 'support@mephed.ng'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tutor-request-notification',
            with: ['tutorRequest' => $this->tutorRequest,
                    'client' => $this->client]
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
