<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Traits\SuperAdmin\UnitFilterTraits;

class UnitController extends Controller
{
    use UnitFilterTraits;

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        // $roles = Role::with('users:id,username')->get();
        $query = Unit::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);


        if ($request->ajax()) {
            return response()->json([
                'table' => view('SuperAdmin.unit.table.unitTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('SuperAdmin.unit.view-all-unit', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|regex:/^[^0-9]+$/'
        ]);

        $validatedData['created_at'] = now();

        Unit::create($validatedData);

        return response()->json([
            'success' => 'Unit Succesfully Added'
        ]);

    }
}
