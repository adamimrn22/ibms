<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

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

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function children()
    {
        return $this->hasMany(UitInventory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(UitInventory::class, 'parent_id');
    }
}
