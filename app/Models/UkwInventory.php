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
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function status(){
        return $this->hasOne(Status::class,  'id' ,'status_id',);
    }

    public function bookings()
    {
        return $this->belongsToMany(UkwInventory::class, 'ukw_bookings_inventories', 'booking_id', 'inventory_id')
                ->withPivot(['quantity', 'approved_quantity', 'status_id'])
                ->withTimestamps();
    }

}
