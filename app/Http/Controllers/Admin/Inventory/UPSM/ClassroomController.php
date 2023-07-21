<?php

namespace App\Http\Controllers\Admin\Inventory\UPSM;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UPSM\ClassroomFilterTraits;
use App\Http\Requests\Admin\Inventory\UPSM\addClassroomRequest;
use App\Http\Requests\Admin\Inventory\UPSM\editClassroomRequest;
use App\Models\UpsmInventory;

class ClassroomController extends Controller
{
    use ClassroomFilterTraits;

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UpsmInventory::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.view-all-classroom', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addClassroomRequest $request)
    {
        $validatedData = $request->validated();

        $attribute = [
            'Chair' => $validatedData['classChair'],
            'Foldable_Chair' => $validatedData['classFoldableChair'],
            'Table' => $validatedData['classTable'],
            'Whiteboard' => $validatedData['classChair'],
            'Duster' => $validatedData['classChair'],
        ];

        Inventory::create([
            'name' => $validatedData['classname'],
            'attribute' => json_encode($attribute),
            'quantity' => 1,
            'stock' => 1,
            'location' => $validatedData['classLocation'],
            'subcategory_id' => 5
        ]);

        $data = Inventory::where('subcategory_id', 5)->paginate(7);

        return response()->json([
            'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Classroom Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Inventory::where('id', $id)->where('subcategory_id', 5)->first();
        $classroom->attribute = json_decode($classroom->attribute);
        return response([
            'classroom' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(editClassroomRequest $request, string $id)
    {

        $validatedData = $request->validated();

        $attribute = [
            'Chair' => $validatedData['classChair'],
            'Foldable_Chair' => $validatedData['classFoldableChair'],
            'Table' => $validatedData['classTable'],
            'Whiteboard' => $validatedData['classChair'],
            'Duster' => $validatedData['classChair'],
        ];

        Inventory::where('id', $id)->update([
            'name' => $validatedData['classname'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['classLocation'],
            'subcategory_id' => 5
        ]);

        $data = Inventory::where('subcategory_id', 5)->paginate(7);

        return response()->json([
            'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Classroom Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inventory::destroy($id);
        $data = Inventory::where('subcategory_id', '=', 5)->paginate(7);

        return response()->json([
            'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Classroom Deleted Successfully'
        ]);
    }
}
