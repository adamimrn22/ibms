<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

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
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $nameParts = explode('.', $permission->name);
            return $nameParts[0]; // Assumes the group is the text before the dot in the permission name
        });

        return response()->json(['groupedPermissions' => $groupedPermissions]);
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
        $user = User::with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $nameParts = explode('.', $permission->name);
            return $nameParts[0]; // Assumes the group is the text before the dot in the permission name
        });

        return response()->json(['user' => $user, 'groupedPermissions' => $groupedPermissions]);
    }


     /**
     * update or create the user permission
     */
    public function storeUserPermission(Request $request, string $id)
    {
        $validatedData = $request->only('permissions');
        $permissions = array_unique($validatedData['permissions']);

        try {
            //code...
            $user = User::findOrFail($id);
            $user->syncPermissions($permissions);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
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

    public function showRoles()
    {
        try {
            $roles = Role::all();
            return response()->json(['roles' => $roles]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

}
