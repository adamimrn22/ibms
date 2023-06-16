<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PermissionRequest;
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
     * Store a permission On Role or not.
     */
    public function store(PermissionRequest $request)
    {
        $validatedData = $request->only(['permissions','role']);
        try {
            DB::beginTransaction();

            // Create the permission
            $permission = Permission::create([
                'name' => $validatedData['permissions']
            ]);

            // Assign the permission to the selected roles
            $roles = Role::whereIn('id', $validatedData['role'])->get();
            $permission->syncRoles($roles);

            $data = Permission::paginate(7);


            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Permission created and assigned successfully',
                'table' => view('SuperAdmin.table.permissionTable', compact('data'))->render()

            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store permission on a user
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
        $permission = Permission::with('roles')->find($id);
        $permissionRoleIds = $permission->roles->pluck('id')->all();

        $allRoles = Role::whereNotIn('id', $permissionRoleIds)->get();// Replace with your logic to fetch all roles

        return response()->json(compact(['permission', 'allRoles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->only(['permissions', 'role']);

            Permission::where('id', $id)->update([
                'name' => $validatedData['permissions']
            ]);

            // Retrieve the updated permission
            $permission = Permission::find($id);

            // Assign the permission to the selected roles
            $roles = Role::whereIn('id', $validatedData['role'])->get();
            $permission->syncRoles([$roles]);

            $data = Permission::paginate(7);

            DB::commit();
            return response()->json([
                'success' => 'Permission name and roles updated ',
                'table' => view('SuperAdmin.table.permissionTable', compact('data'))->render()
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::find($id);
            $permission->delete();

            $data = Permission::paginate(7);

            return response()->json([
                'success' => 'Permission name and roles updated ',
                'table' => view('SuperAdmin.table.permissionTable', compact('data'))->render(),
                'paginate' => view('components.Pagination', compact('data'))->render()
            ]);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
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

    public function delteUserPermissionRoles(string $id)
    {
        try {
            $user = User::find($id);

            $user->roles()->detach();
            $user->permissions()->detach();

            return response()->json([
                'status' => 'success',
                'message' => 'User Role and Permission Has been deleted',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

}
