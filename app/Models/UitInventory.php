<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UitInventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'inventory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'location', 'id');
    }

    public function children()
    {
        return $this->hasMany(Inventory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Inventory::class, 'parent_id');
    }
}
