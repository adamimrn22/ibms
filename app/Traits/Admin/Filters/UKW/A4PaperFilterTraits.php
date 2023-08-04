<?php

namespace App\Traits\Admin\Filters\UKW;

trait A4PaperFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 22);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 22)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }
        // Apply pagination
        return $query->paginate($perPage);
    }


}
