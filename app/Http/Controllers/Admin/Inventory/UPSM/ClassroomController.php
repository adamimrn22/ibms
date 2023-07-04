<?php

namespace App\Http\Controllers\Admin\Inventory\UPSM;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Inventory\UPSM\addClassroomRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

class ClassroomController extends Controller
{
    public function index()
    {
        $data = Inventory::where('subcategory_id', 5)->paginate(7);
        return view('Admin.AdminUPSM.view-all-classroom', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'success' => 'Classroom Added Successfully'
        ]);
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
