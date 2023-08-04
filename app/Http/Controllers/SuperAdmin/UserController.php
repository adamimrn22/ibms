<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Unit;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\SuperAdmin\Filters\UserFilterTraits;
use App\Http\Requests\SuperAdmin\User\AddUserRequest;
use App\Http\Requests\SuperAdmin\User\EditUserRequest;
use App\Models\UserPaperBookingAmount;

class UserController extends Controller
{
    use UserFilterTraits;
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['role_or_permission:Super Admin|user.view']);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = User::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        $userCounts = $this->getUserCounts();

        if ($request->ajax()) {
            return response()->json([
                'table' => view('SuperAdmin.user.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }
        return view('SuperAdmin.user.view-all-user', compact('data') + $userCounts);
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
            $user = Auth::user();

            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($validatedData['username']);
            $validatedData['created_at'] = now();

            if ($user->hasRole('Admin UPSM')) {
                $validatedData['userRole'] = 'User';
            }

            $user = User::create($validatedData);

            $user->assignRole($validatedData['userRole']);
            $user->syncPermissions();

            UserPaperBookingAmount::create([
                'user_id' => $user->id,
                'amount' => 3,
                'default_amount' => 3,
                'month' => date("m"),
                'year' => date("Y")
            ]);

            $userCounts = $this->getUserCounts();
            $data = User::paginate(7);

            return response()->json([
                'sucess' => 'User successfully created',
                'userTotal' => view('SuperAdmin.user.section.UserSection', $userCounts)->render(),
                'table' => view('SuperAdmin.user.table.userTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
           ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $positions = Position::all();
        $units = Unit::all();

        return response()->json([
            'user' => $user,
            'positions' => $positions,
            'units' => $units
        ]);
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

            $userCounts = $this->getUserCounts();
            $data = User::paginate(7);

            return response()->json([
                'success' => 'User Succesfully Updated',
                'userTotal' => view('SuperAdmin.user.section.UserSection', $userCounts)->render(),
                'table' => view('SuperAdmin.user.table.userTable', compact('data'))->render(),
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
        User::destroy($id);

        $userCounts = $this->getUserCounts();
        $data = User::paginate(7);

        return response()->json([
            'success' => 'User Succesfully Deleted',
            'userTotal' => view('SuperAdmin.user.section.UserSection', $userCounts)->render(),
            'table' => view('SuperAdmin.user.table.userTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
        ]);
    }

    /**
     * Get The User Count
     */
   private function getUserCounts()
    {
        $totalUserCount = User::count();
        $userActiveCount = User::where('isActive', 1)->count();
        $userNotActiveCount = $totalUserCount - $userActiveCount;
        $totalUserWithRoles = User::whereHas('roles', function ($query) {
            $query->where('id', 5);
        })->count();

        return compact('totalUserCount', 'userActiveCount', 'userNotActiveCount', 'totalUserWithRoles');
    }
}
