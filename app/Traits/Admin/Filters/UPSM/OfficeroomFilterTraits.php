<?php

namespace App\Traits\Admin\Filters\UPSM;

trait OfficeroomFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 13);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 13)
                    ->where('name', 'LIKE', "%{$searchTerm}%");

        }
        // Apply pagination
        return $query->paginate($perPage);
    }
}
