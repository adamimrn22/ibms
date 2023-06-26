<?php

namespace App\Traits\SuperAdmin\Filters;

trait CategoryFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where('category_name', 'LIKE', "%{$searchTerm}%");
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
