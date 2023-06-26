<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\SuperAdmin\Filters\CategoryFilterTraits;

class CategoryController extends Controller
{
    use CategoryFilterTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');

        $query = Category::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);


        if ($request->ajax()) {
            return response()->json([
                // 'table' => view('SuperAdmin.unit.table.unitTable', compact('data'))->render(),
                // 'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('SuperAdmin.Category.view-all-category', compact('data'));
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
}
