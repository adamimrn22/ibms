<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('permissions');

        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $role = $request->input('role');

        if ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }


        if ($role) {
            $query->role($role);
        }

        $data = $query->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('SuperAdmin.table.permissionTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render()
            ]);
        }


        return view('SuperAdmin.view-all-permission', compact('data'));
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