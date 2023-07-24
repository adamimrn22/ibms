<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomImage extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'parent_folder','path'];

    public function upsmInventory()
    {
        return $this->belongsTo(UpsmInventory::class, 'classroom_id', 'id');
    }
}
