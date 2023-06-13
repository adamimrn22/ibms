<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\RolesRequest;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $role = $request->input('role');
        $roles = Role::with('users:id,username')->get();
        $query = User::with('roles')->where('isActive', true);

        // For search filtering ajax
        if ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        // For role filtering ajax
        if ($role) {
            $query->whereHas('roles', function ($q) use ($role) {
                if ($role === 'Admin') {
                    $q->where('name', 'like', '%Admin%')
                        ->where('name', '!=', 'Super Admin');
                } else {
                    $q->where('name', $role);
                }
            });
        }

        $data = $query->paginate($perPage);

        $startingNumber = ($data->currentPage() - 1) * $data->perPage() + 1;

        if ($request->ajax()) {
            return response()->json([
                'table' => view('SuperAdmin.table.roleTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('SuperAdmin.view-all-roles', compact('data', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {
        $validatedData = $request->only('name', 'permissions');
        $permissions = array_unique($validatedData['permissions']);

        try {
            //code...
            $role = Role::create(['name' => $validatedData['name']]);
            $role->syncPermissions($permissions);

            $roles = Role::with('users:id,username')->get();

            return response()->json([
                'roleSection' => view('SuperAdmin.section.RoleSection', compact('roles'))->render(),
            ]);

        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $nameParts = explode('.', $permission->name);
            return $nameParts[0]; // Assumes the group is the text before the dot in the permission name
        });

        return response()->json(['role' => $role, 'groupedPermissions' => $groupedPermissions]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolesRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesRequest $request, string $id)
    {
        $validatedData = $request->only(['id', 'name', 'permissions']);

        $permissions = array_unique($validatedData['permissions']);


        try {

            Role::where('id', $validatedData['id'])
                ->update([
                    'name' => $validatedData['name'],
                    'updated_at' => now()
                ]);

            $role = Role::findById($validatedData['id']);

            // Synchronize the role's permissions with the provided permissions array
            $role->syncPermissions($permissions);

            // Role permissions successfully updated
            // Add any additional code or response as needed
            $roles = Role::with('users:id,username')->get();
            return response()->json([
                'roleSection' => view('SuperAdmin.section.RoleSection', compact('roles'))->render(),
            ]);}

         catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            // Return an appropriate error response or log the error
            return response()->json(['error' => 'Failed to update role permissions'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        // Get the updated roles data
        $roles = Role::with('users:id,username')->get();

        // Render the updated role section HTML
        $roleSection = view('SuperAdmin.section.RoleSection', compact('roles'))->render();

        // Return the updated HTML in the response
        return response()->json([
            'success' => true,
            'roleSection' => $roleSection,
        ]);
    }


}
