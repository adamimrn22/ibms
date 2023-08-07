<?php

namespace App\Mail;

use App\Models\UkwBooking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveAlatTulis extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $bookings;
    protected $orderID;
    protected $totalQuantity;
    protected $approvedDate;
    protected $bookDate;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $reference)
    {
        $this->user = $user;
        $this->bookings = UkwBooking::with('inventory', 'status')->where('reference', $reference)->get();
        $this->orderID = $reference;
        $this->totalQuantity = $this->bookings->sum('approved_quantity');

        $formatBookDate = Carbon::parse($this->bookings[0]->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $formatApprovedDate = Carbon::parse($this->bookings[0]->updated_at)->formatLocalized('%B %d, %Y %I:%M %p');

        $this->bookDate =  $formatBookDate;
        $this->approvedDate =  $formatApprovedDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pinjaman Alat Tulis Telah Dilulus',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.bookingAlatTulis.approvedBooking',
            with: [
                'user' => $this->user,
                'bookings' => $this->bookings,
                'orderID' => $this->orderID,
                'totalQuantity' => $this->totalQuantity,
                'bookDate' => $this->bookDate,
                'approvedDate' => $this->approvedDate,
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
