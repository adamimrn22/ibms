<?php

namespace App\Traits\Admin\Filters\UIT\Hardware;

use Illuminate\Support\Facades\DB;

trait DesktopFilterTraits
{
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm,  $status)
    {

        $query->where('subcategory_id', '=', 1) ;
        // For search filtering
        if ($searchTerm) {
            $query->where('subcategory_id', '=', 1)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                        ->orWhereRaw("JSON_EXTRACT(attribute, '$.model') LIKE ?", ["%{$searchTerm}%"]);
                });
        }

        if ($status && $status !== 'ALL') {
            $query->where('status_id', '=', "$status");
        }

        // Apply pagination
        $results = $query->select('name', DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.model')) AS model"), 'location', 'status_id', 'id')->paginate($perPage);

        return $results;
    }
}
