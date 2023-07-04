<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    public function Unit()
    {
        return $this->hasMany(Unit::class);
    }

    public function Subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
