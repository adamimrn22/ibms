<?php

namespace App\Traits\Admin\Filters\UPSM;

trait ClassroomFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 5);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 5)
                    ->where('name', 'LIKE', "%{$searchTerm}%");

        }
        // Apply pagination
        return $query->paginate($perPage);
    }
}