<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpsmVehicleBooking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staff()
    {
        return $this->belongsToMany(User::class, 'upsm_vehicle_bookings_user', 'booking_id', 'user_id');
    }

    public function inventory()
    {
        return $this->belongsTo(UpsmInventory::class, 'inventory_id');
    }

    public function status()
    {
        return $this->hasOne(BookingStatus::class, 'id', 'status_id');
    }
}
