<?php

namespace App\Mail;

use App\Models\Sabbatical;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SabbaticalCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Sabbatical $sabbatical;
    public string $sabbaticalUrl;
    public string $dashboardUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Sabbatical $sabbatical)
    {
        $this->sabbatical = $sabbatical;
        $this->sabbaticalUrl = route('sabbaticals.show', $sabbatical);
        $this->dashboardUrl = route('dashboard');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sabbatical Request Submitted - ' . $this->sabbatical->destination,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.sabbatical.created',
            with: [
                'sabbatical' => $this->sabbatical,
                'sabbaticalUrl' => $this->sabbaticalUrl,
                'dashboardUrl' => $this->dashboardUrl,
            ],
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
