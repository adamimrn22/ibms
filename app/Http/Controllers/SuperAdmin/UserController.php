<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Unit;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\SuperAdmin\UserFilterTraits;

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
    public function store(Request $request)
    {
        try {
            //code...
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
