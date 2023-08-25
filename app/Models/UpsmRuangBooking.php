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

    public function status()
    {
        return $this->hasOne(BookingStatus::class, 'id', 'status_id');
    }

    public function isAvailable($startTime, $endTime)
    {
        $roomId = $this->room_id;

        $existingBookings = DB::table('upsm_ruang_bookings')
            ->where('room_id', $roomId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($query) use ($startTime, $endTime) {
                    $query->where('date_book_start', '<=', $endTime->toDateString())
                        ->where('date_book_end', '>=', $startTime->toDateString())
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query->where('time_start', '<=', $endTime->toTimeString())
                                ->where('time_end', '>=', $startTime->toTimeString());
                        });
                })
                ->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('date_book_start', '=', $startTime->toDateString())
                        ->where('time_start', '<=', $endTime->toTimeString());
                })
                ->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('date_book_end', '=', $endTime->toDateString())
                        ->where('time_end', '>=', $startTime->toTimeString());
                });
            })
            ->count();

        return $existingBookings === 0;
    }

}
