<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkwBooking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventory()
    {
        return $this->belongsTo(UkwInventory::class, 'inventory_id');
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
