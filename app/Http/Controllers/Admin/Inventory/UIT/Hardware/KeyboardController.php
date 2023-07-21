<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Status;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\KeyboardFilterTraits;

class KeyboardController extends Controller
{
    use KeyboardFilterTraits, StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.keyboardTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.keyboard.view-all-keyboard', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.keyboard.create-keyboard', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'keyboardID' => 'required|unique:uit_inventories,name',
            'keyboardBrand' => 'required',
            'keyboardModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'keyboardType' => 'required',
            'connection' => 'array|required',
            'dimension' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['keyboardBrand'],
            'model' => $validatedData['keyboardModel'],
            'dimension' => $validatedData['dimension'],
            'keyboardType' => $validatedData['keyboardType'],
            'connection' => json_encode($validatedData['connection']),
            'dimension' => $validatedData['dimension'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['keyboardID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 5,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Keyboard.index')
        ->with('success', 'Keyboard added successfully!');
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
    public function edit(string $encryptId)
    {
        $id = Crypt::decrypt($encryptId);
        $keyboard = UitInventory::with('subcategory.category')->findOrFail($id);
        $keyboard->attribute = json_decode($keyboard->attribute);
        $keyboard->attribute->connection = json_decode( $keyboard->attribute->connection );
        $category = $keyboard->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.keyboard.edit-keyboard', compact('keyboard', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'keyboardID' => 'required|unique:uit_inventories,name,' . $id,
            'keyboardBrand' => 'required',
            'keyboardModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'keyboardType' => 'required',
            'connection' => 'array|required',
            'dimension' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['keyboardBrand'],
            'model' => $validatedData['keyboardModel'],
            'dimension' => $validatedData['dimension'],
            'keyboardType' => $validatedData['keyboardType'],
            'connection' => json_encode($validatedData['connection']),
            'dimension' => $validatedData['dimension'],
            'weight' => $validatedData['weight'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['keyboardID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Keyboard.index')
        ->with('success', 'Keyboard updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.keyboardTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Keyboard deleted successfully'
        ]);
    }
}
