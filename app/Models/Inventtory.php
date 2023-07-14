<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'inventory';

    public function Subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'inventory_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'location', 'id');
    }

}
