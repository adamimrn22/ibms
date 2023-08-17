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

class UserBookingUKW extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $booking;
    protected $totalQuantity;
    protected $orderID;
    protected $date;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $reference )
    {
        $this->user = $user;
        $this->booking = UkwBooking::with('inventories')
            ->withSum('inventories', 'ukw_bookings_inventories.quantity')
            ->where('reference', $reference)->first();


        $this->orderID = $reference;
        $this->totalQuantity = $this->booking->inventories_sum_ukw_bookings_inventoriesquantity;

        $formatDate = Carbon::parse($this->booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $this->date =  $formatDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pinjaman Alat Tulis berjaya!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ukwuserbooking',
            with: [
                'user' => $this->user,
                'booking' => $this->booking,
                'orderID' => $this->orderID,
                'totalQuantity' => $this->totalQuantity,
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
