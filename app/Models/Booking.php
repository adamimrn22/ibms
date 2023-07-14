<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'booking';

    public $timestamps = false;

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
