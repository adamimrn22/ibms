<?php

namespace App\Traits\SuperAdmin;

trait UnitFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
