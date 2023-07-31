<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\ProjectorFilterTraits;

class ProjectorController extends Controller
{
    use ProjectorFilterTraits, StatusTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UitInventory::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUIT.table.Hardware.projectorTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.projector.view-all-projector', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.projector.create-projector', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'projectorID' => 'required|unique:uit_inventories,name',
            'price' => 'required',
            'projectorBrand' => 'required',
            'projectorModel' => 'required',
            'location' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['projectorBrand'],
            'model' => $validatedData['projectorModel'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['projectorID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 7,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Projector.index')
        ->with('success', 'Projector added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $projector = UitInventory::findOrFail($id);
        $projector->attribute = json_decode($projector->attribute);

        return view('Admin.AdminUIT.crud.hardware.projector.projector-details', compact('projector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $projector = UitInventory::with('subcategory.category')->findOrFail($id);
        $projector->attribute = json_decode($projector->attribute);
        $category = $projector->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.projector.edit-projector', compact('projector', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'projectorID' => 'required|unique:uit_inventories,name,' . $id,
            'price' => 'required',
            'projectorBrand' => 'required',
            'projectorModel' => 'required',
            'location' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['projectorBrand'],
            'model' => $validatedData['projectorModel'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['projectorID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Projector.index')
        ->with('success', 'Projector updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = UitInventory::query();
        UitInventory::destroy($id);

        $data = $this->applyPaginationFilterSearch($query, 7, '', '');
        return response()->json([
            'table' => view('Admin.AdminUIT.table.Hardware.projectorTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Projector deleted successfully'
        ]);
    }
}
