<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SuperAdmin\Filters\PositionFilterTraits;

class PositionController extends Controller
{
    use PositionFilterTraits;

    public function __construct()
    {
        $this->middleware(['role_or_permission:Super Admin|position.view']);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');

        $query = Position::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('SuperAdmin.position.table.positionTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('SuperAdmin.position.view-all-positions', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|regex:/^[^0-9]+$/'
        ]);

        $validatedData['created_at'] = now();

        Position::create($validatedData);

        $data = Position::paginate(7);

        return response()->json([
            'success' => 'Position Succesffuly Added',
            'table' => view('SuperAdmin.position.table.positionTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);
    }

    public function show(string $id){
        $position = Position::findOrFail($id)->name;

        return response()->json([
            'position' => $position
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|regex:/^[^0-9]+$/|unique:positions,name,' . $id
        ]);

        $validatedData['updated_at'] = now();

        Position::where('id', $id)->update($validatedData);

        $data = Position::paginate(7);

        return response()->json([
            'success' => 'Position Succesfully Updated',
            'table' => view('SuperAdmin.position.table.positionTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);
    }

    public function destroy(string $id)
    {
        Position::destroy($id);

        $data = Position::paginate(7);

        return response([
            'success' => 'Position Succesfully Deleted',
            'table' => view('SuperAdmin.position.table.positionTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render()
        ]);
    }


}
