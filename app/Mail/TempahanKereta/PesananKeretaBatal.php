<?php

namespace App\Mail\TempahanKereta;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PesananKeretaBatal extends Mailable
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
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->randomString = substr(str_shuffle($characters), 0, 10);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan Kereta Batal',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pdf.pesanan-reject',
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
