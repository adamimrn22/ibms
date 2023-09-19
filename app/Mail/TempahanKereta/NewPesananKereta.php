<?php

namespace App\Mail\TempahanKereta;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\UpsmVehicleBooking;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPesananKereta extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $booking;
    protected $orderID;
    protected $date;
    protected $randomString;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $user)
    {
        $this->user = $user;
        $this->booking =  UpsmVehicleBooking::with('staff')->findOrFail($booking->id);

        $this->orderID = $this->booking->reference;

        $formatDate = Carbon::parse($this->booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $this->date =  $formatDate;

        $this->randomString  = Str::random(20);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Pesanan Kereta',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.TempahanKereta.pesanan-baharu',
            with: [
                'user' => $this->user,
                'randomness' => $this->randomString,
                'booking' => $this->booking,
                'orderID' => $this->orderID,
                'date' => $this->date,
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
