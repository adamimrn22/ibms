<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Status;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\MouseFilterTraits;

class MouseController extends Controller
{
    use MouseFilterTraits, StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.mouseTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.mouse.view-all-mouse', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.mouse.create-mouse', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'mouseID' => 'required|unique:uit_inventories,name',
            'mouseBrand' => 'required',
            'mouseModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'mouseType' => 'required',
            'connection' => 'array|required',
            'dpi' => 'required',
            'dimension' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['mouseBrand'],
            'model' => $validatedData['mouseModel'],
            'dimension' => $validatedData['dimension'],
            'mouseType' => $validatedData['mouseType'],
            'connection' => json_encode($validatedData['connection']),
            'dimension' => $validatedData['dimension'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'dpi' => $validatedData['dpi'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['mouseID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 4,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Mouse.index')
        ->with('success', 'Mouse added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $mouse = UitInventory::findOrFail($id);

        // location based name eg desktop name
        $location = UitInventory::select('name', 'id', 'subcategory_id')->where('name', '=', $mouse->location)->first();

        $mouse->attribute = json_decode($mouse->attribute);
        $mouse->attribute->connection = json_decode($mouse->attribute->connection);

        return view('Admin.AdminUIT.crud.hardware.mouse.mouse-details', compact('mouse', 'location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $mouse = UitInventory::with('subcategory.category')->findOrFail($id);
        $mouse->attribute = json_decode($mouse->attribute);
        $mouse->attribute->connection = json_decode( $mouse->attribute->connection );
        $category = $mouse->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.mouse.edit-mouse', compact('mouse', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'mouseID' => 'required|unique:uit_inventories,name,' . $id,
            'mouseBrand' => 'required',
            'mouseModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'mouseType' => 'required',
            'connection' => 'array|required',
            'dpi' => 'required',
            'dimension' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['mouseBrand'],
            'model' => $validatedData['mouseModel'],
            'dimension' => $validatedData['dimension'],
            'mouseType' => $validatedData['mouseType'],
            'connection' => json_encode($validatedData['connection']),
            'dimension' => $validatedData['dimension'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'dpi' => $validatedData['dpi'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['mouseID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Mouse.index')
        ->with('success', 'Mouse updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.mouseTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Mouse deleted successfully'
        ]);
    }
}
