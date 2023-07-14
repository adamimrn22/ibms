<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategory';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function inventories()
    {
        return $this->belongsTo(Inventory::class);
    }
}
