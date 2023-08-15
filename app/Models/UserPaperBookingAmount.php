<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaperBookingAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subtractAmount($amount)
    {
        $this->amount -= $amount;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
