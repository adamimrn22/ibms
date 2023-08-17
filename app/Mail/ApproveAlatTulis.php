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
    protected $booking;
    protected $orderID;
    protected $totalQuantity;
    protected $approvedDate;
    protected $bookDate;
    protected $randomString;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $reference)
    {
        $this->user = $user;
        $this->booking =  UkwBooking::with('inventories', 'status')
        ->withSum('inventories', 'ukw_bookings_inventories.quantity')
        ->where('reference', $reference)->first();

        $this->orderID = $reference;
        $this->totalQuantity = $this->booking->inventories_sum_ukw_bookings_inventoriesquantity;


        $formatBookDate = Carbon::parse($this->booking->created_at)->formatLocalized('%B %d, %Y %I:%M %p');
        $formatApprovedDate = Carbon::parse($this->booking->updated_at)->formatLocalized('%B %d, %Y %I:%M %p');

        $this->bookDate =  $formatBookDate;
        $this->approvedDate =  $formatApprovedDate;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // gmail trim the mail this is for not making it trim
        $this->randomString = substr(str_shuffle($characters), 0, 10);
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
                'randomness' => $this->randomString,
                'booking' => $this->booking,
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
