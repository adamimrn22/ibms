<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Unit;
use App\Models\User;
use App\Models\Position;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\SuperAdmin\UserFilterTraits;
use App\Http\Requests\SuperAdmin\User\AddUserRequest;
use App\Http\Requests\SuperAdmin\User\EditUserRequest;

class UserController extends Controller
{
    use UserFilterTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        // $roles = Role::with('users:id,username')->get();
        $query = User::query();

        $totalUserCount = User::count();
        $userActiveCount = User::where('isActive', 1)->count();
        $userNotActiveCount = $totalUserCount - $userActiveCount;
        $totalUserWithRoles = DB::table('model_has_roles')->where('role_id', '5')->count();


        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);

        $startingNumber = ($data->currentPage() - 1) * $data->perPage() + 1;

        if ($request->ajax()) {
            return response()->json([
                'userTotal' => view('SuperAdmin.section.UserSection', compact(
                                'totalUserCount', 'userActiveCount',
                                'userNotActiveCount', 'totalUserWithRoles'
                            )),
                'table' => view('SuperAdmin.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }
        return view('SuperAdmin.user.view-all-user',
            compact('data', 'totalUserCount', 'userActiveCount',
                'userNotActiveCount', 'totalUserWithRoles')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $unit = Unit::all();

        return response()->json([
            'positions' => $positions,
            'unit' => $unit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($validatedData['username']);
            $validatedData['created_at'] = now();

            $user = User::create($validatedData);
            $user->assignRole('User');
            $user->syncPermissions($user->roles->flatMap->permissions);

            $data = User::paginate(7);

            $totalUserCount = User::count();
            $userActiveCount = User::where('isActive', 1)->count();
            $userNotActiveCount = $totalUserCount - $userActiveCount;
            $totalUserWithRoles = DB::table('model_has_roles')->where('role_id', '5')->count();

            return response()->json([
                'userTotal' => view('SuperAdmin.section.UserSection', compact(
                    'totalUserCount', 'userActiveCount',
                    'userNotActiveCount', 'totalUserWithRoles'
                ))->render(),
                'table' => view('SuperAdmin.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'User Added Succesfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
           ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::leftJoin('units', 'users.unit_id', '=', 'units.id')
        ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
        ->select('users.*', 'units.name as unit_name', 'positions.name as position_name')
        ->findOrFail($id);
        $positions = Position::all();
        $units = Unit::all();

        $userUnit = [$user->unit_name, $user->unit_id];
        $userPositions = [$user->position_name, $user->position_id];

        return response()->json([
            'user' => $user,
            'userUnit' => $userUnit,
            'userPositions' => $userPositions,
            'positions' => $positions,
            'units' => $units
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['updated_at'] = now();

            User::where('id', $id)->update($validatedData);

                        $totalUserCount = User::count();
            $userActiveCount = User::where('isActive', 1)->count();
            $userNotActiveCount = $totalUserCount - $userActiveCount;

            $data = User::paginate(7);

            return response()->json([
                'sucess' => 'User Successfully Updated',
                'table' => view('SuperAdmin.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::destroy($id);
            Storage::delete('avatars/' . $id . '.svg');
            $data = User::paginate(7);

            $totalUserCount = User::count();
            $userActiveCount = User::where('isActive', 1)->count();
            $userNotActiveCount = $totalUserCount - $userActiveCount;
            $totalUserWithRoles = DB::table('model_has_roles')->where('role_id', '5')->count();

            return response()->json([
                'userTotal' => view('SuperAdmin.section.UserSection', compact(
                    'totalUserCount', 'userActiveCount',
                    'userNotActiveCount', 'totalUserWithRoles'
                ))->render(),
                'table' => view('SuperAdmin.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'User Deleted Succesfully'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ]);
        }


    }
}
