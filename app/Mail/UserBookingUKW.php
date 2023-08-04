<?php

namespace App\Mail;

use Carbon\Carbon;
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
    protected $bookings;
    protected $totalQuantity;
    protected $orderID;
    protected $date;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $bookings )
    {
        $this->user = $user;
        $this->bookings = $bookings;

        $this->orderID = $bookings[0]->reference;
        $this->totalQuantity = $bookings->sum('quantity');
        $formatDate = Carbon::parse($bookings[0]->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
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
                'bookings' => $this->bookings,
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
