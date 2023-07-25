<?php

namespace App\Traits\Admin;

use App\Models\Status;
use App\Models\SubCategory;

trait SubcategoryTraits
{
    public function Subcategory($id)
    {
        $subcategory = SubCategory::where('category_id', $id)->get();
        return $subcategory;
    }
}
