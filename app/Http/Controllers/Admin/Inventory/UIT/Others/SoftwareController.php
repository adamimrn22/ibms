<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function applyPaginationFilterSearch($query, $perPage, $searchTerm,  $status)
    // {
    //     $query->where('subcategory_id', '=', 23) ;
    //     // For search filtering
    //     if ($searchTerm) {
    //         $query->where('subcategory_id', '=', 23)
    //             ->where(function ($query) use ($searchTerm) {
    //                 $query->where('name', 'LIKE', "%{$searchTerm}%")
    //                     ->orWhere('location', 'LIKE', "%{$searchTerm}%")
    //                     ->orWhereRaw("JSON_EXTRACT(attribute, '$.brand') LIKE ?", ["%{$searchTerm}%"]);
    //             });
    //     }

    //     if ($status && $status !== 'ALL') {
    //         $query->where('status_id', '=', "$status");
    //     }

    //     // Apply pagination
    //     $results = $query->select('name', DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.brand')) AS brand"), 'location', 'status_id', 'id')->paginate($perPage);

    //     return $results;
    // }
}
