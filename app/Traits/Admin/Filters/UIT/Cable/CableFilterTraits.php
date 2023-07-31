<?php

namespace App\Traits\Admin\Filters\UIT\Cable;

trait CableFilterTraits
{
    public function applyPaginationFilterSearch($query, $subcategory, $perPage, $searchTerm, $status)
    {
        $query->where('subcategory_id', '=', $subcategory);
        // For search filtering
        if ($searchTerm) {
                $query->where('subcategory_id', '=', $subcategory)
                    ->where('name', 'LIKE', "%{$searchTerm}%");
        }

        if ($status && $status !== 'ALL') {
            $query->where('status_id', '=', "$status");
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
