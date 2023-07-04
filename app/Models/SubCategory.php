<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategory';

    public function Category()
    {
        return $this->hasMany(Category::class);
    }

    public function Inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
