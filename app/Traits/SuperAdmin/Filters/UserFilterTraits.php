<?php

namespace App\Traits\SuperAdmin\Filters;

trait UserFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm, $status)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where('first_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('username', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        // For status filtering
        if ($status !== null) {
            if ($status == 1) {
                $query->where('isActive', '=', 1);
            } else if ($status == 0) {
                $query->where('isActive', '=', 0);
            }
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
