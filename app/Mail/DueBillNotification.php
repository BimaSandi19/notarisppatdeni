<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DueBillNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $dueBills;
    public $admin;
    public $count;
    public $totalNominal;

    /**
     * Create a new message instance.
     */
    public function __construct(Collection $dueBills, $admin)
    {
        $this->dueBills = $dueBills;
        $this->admin = $admin;
        $this->count = $dueBills->count();
        $this->totalNominal = $dueBills->sum('nominal_tagihan');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->count === 1
            ? '[Pengingat] 1 Tagihan Akan Jatuh Tempo Besok'
            : "[Pengingat] {$this->count} Tagihan Akan Jatuh Tempo Besok";

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.due-bill-notification',
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
