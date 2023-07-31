<?php

namespace App\Traits\Admin\Filters\UPSM;

trait CarFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        $query->where('subcategory_id', '=', 15);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', 15)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }
        // Apply pagination
        return $query->paginate($perPage);
    }
}
