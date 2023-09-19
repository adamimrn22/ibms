<?php

namespace App\Mail\TempahanKereta;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PesananKeretaLulus extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $randomString;

    /**
     * Create a new message instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
        //for gmail due to trimming
        $this->randomString  = Str::random(20);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan Kereta Lulus',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.tempahanKereta.pesanan-lulus',
            with: [
                'orderID' => $this->booking->reference,
                'date' => Carbon::parse($this->booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p'),
                'randomness' => $this->randomString,
            ]
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
