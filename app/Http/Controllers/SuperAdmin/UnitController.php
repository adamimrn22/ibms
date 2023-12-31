<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Traits\SuperAdmin\Filters\UnitFilterTraits;

class UnitController extends Controller
{
    use UnitFilterTraits;

    public function __construct()
    {
        $this->middleware(['role_or_permission:Super Admin|unit.view']);
    }


    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');

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
            'name' => 'required|min:5|regex:/^[^0-9]+$/|unique:units,name'
        ]);

        $validatedData['created_at'] = now();

        Unit::create($validatedData);

        $data = Unit::paginate(7);

        return response()->json([
            'success' => 'Unit Succesfully Added',
            'table' => view('SuperAdmin.unit.table.unitTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);

    }

    public function show(string $id){
        $unit = Unit::findOrFail($id)->name;

        return response()->json([
            'unit' => $unit
        ]);
    }

    public function update(Request $request, string $id){

        $validatedData = $request->validate([
            'name' => 'required|min:5|regex:/^[^0-9]+$/|unique:units,name,' . $id
        ]);

        $validatedData['updated_at'] = now();

        Unit::where('id', $id)->update($validatedData);

        $data = Unit::paginate(7);

        return response()->json([
            'success' => 'Unit Succesfully Updated',
            'table' => view('SuperAdmin.unit.table.unitTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);
    }

    public function destroy(string $id)
    {
        Unit::destroy($id);

        $data = Unit::paginate(7);

        return response([
            'success' => 'Unit Succesfully Deleted',
            'table' => view('SuperAdmin.unit.table.unitTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);
    }

}
