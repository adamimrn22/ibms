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

    protected $booking;
    protected $rejectedDate;
    protected $bookDate;
    protected $bookingID;
    /**
     * Create a new message instance.
     */
    public function __construct($reference)
    {
        $this->booking =  UkwBooking::with('inventories')
        ->withSum('inventories', 'ukw_bookings_inventories.quantity')
        ->where('reference', $reference)->first();

        $formatBookDate = Carbon::parse($this->booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $formatApprovedDate = Carbon::parse($this->booking->updated_at)->formatLocalized('%B %d, %Y %I:%M %p');

        $this->bookingID = $reference;
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
                'bookingID' => $this->bookingID,
                'booking' => $this->booking,
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
