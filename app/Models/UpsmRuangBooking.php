<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpsmRuangBooking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detail()
    {
        return $this->hasOne(UpsmRuangBookingDetails::class, 'booking_id');
    }

    public function room()
    {
        return $this->hasOne(UpsmInventory::class, 'id', 'room_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne(BookingStatus::class, 'id', 'status_id');
    }

    // this doesnt work dont know how to do maybe someone will do it
    public function isAvailable($startDatetime, $endDatetime)
    {
        $roomId = $this->room_id;

        $existingBookings = DB::table('upsm_ruang_bookings')
        ->where('room_id', $roomId)
        ->whereDate('date_book_start', '<=', $startDatetime)
        ->whereDate('date_book_end', '>=', $endDatetime)
        ->count();

        return $existingBookings === 0;

    }

}
