<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpsmRuangBookingDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(UpsmRuangBooking::class);
    }
}
