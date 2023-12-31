<?php

namespace App\Traits\Admin\Filters\UKW;

trait StationeryFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 18);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 18)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }
        // Apply pagination
        return $query->paginate($perPage);
    }
}
