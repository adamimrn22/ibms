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
}
