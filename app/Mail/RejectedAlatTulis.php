<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\UkwBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectedAlatTulis extends Mailable
{
    use Queueable, SerializesModels;

    protected $bookings;
    protected $rejectedDate;
    protected $bookDate;
    /**
     * Create a new message instance.
     */
    public function __construct($reference)
    {
        $this->bookings = UkwBooking::with('inventory', 'user')->where('reference', $reference)->get();

        $formatBookDate = Carbon::parse($this->bookings[0]->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $formatApprovedDate = Carbon::parse($this->bookings[0]->updated_at)->formatLocalized('%B %d, %Y %I:%M %p');

        $this->bookDate =  $formatBookDate;
        $this->rejectedDate =  $formatApprovedDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rejected Alat Tulis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.BookingAlatTulis.rejectedBooking',
            with: [
                'bookings' => $this->bookings,
                'bookDate' => $this->bookDate,
                'rejectedDate' => $this->rejectedDate,
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
