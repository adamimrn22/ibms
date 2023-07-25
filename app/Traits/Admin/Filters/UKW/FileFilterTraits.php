<?php

namespace App\Traits\Admin\Filters\UKW;

trait FileFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 16);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 16)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }
        // Apply pagination
        return $query->paginate($perPage);
    }
}
