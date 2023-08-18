<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkwBooking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventories()
    {
        return $this->belongsToMany(UkwInventory::class, 'ukw_bookings_inventories', 'booking_id', 'inventory_id')
                    ->withPivot(['quantity', 'approved_quantity', 'remarkNotes', 'status_id'])
                    ->withTimestamps();
    }

    public function status()
    {
        return $this->hasOne(BookingStatus::class, 'id', 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
