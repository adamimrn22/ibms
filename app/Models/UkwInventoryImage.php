<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkwInventoryImage extends Model
{
    use HasFactory;


    protected $fillable = ['inventories_id', 'parent_folder','path'];

    public function ukwInventory()
    {
        return $this->belongsTo(UkwInventory::class, 'inventories_id', 'id');
    }
}
