<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpsmInventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ClassroomImage::class, 'classroom_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function bookingRoom()
    {
        return $this->belongsTo(UpsmRuangBooking::class);
    }

    public function status(){
        return $this->hasOne(Status::class,  'id' ,'status_id',);
    }


}
