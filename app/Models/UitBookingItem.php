<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UitBookingItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsToMany(UitInventory::class, 'uit_booking_items_inventories', 'booking_id', 'inventory_id')
        ->withTimestamps();
    }
}
