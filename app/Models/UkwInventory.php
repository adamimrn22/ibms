<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkwInventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasOne(UkwInventoryImage::class, 'inventories_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function status(){
        return $this->hasOne(Status::class,  'id' ,'status_id',);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'inventory_id');
    }
}
