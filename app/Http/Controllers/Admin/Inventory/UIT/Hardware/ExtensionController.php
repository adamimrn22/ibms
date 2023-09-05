<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UIT\Hardware\ExtensionCordFilterTraits;
use Illuminate\Support\Facades\Crypt;

class ExtensionController extends Controller
{
    use ExtensionCordFilterTraits, StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.extensionCordTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.extension_cord.view-all-extension-cord', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.extension_cord.create-extension-cord', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'extensionCordID' => 'required|unique:uit_inventories,name',
            'brand' => 'required',
            'length' => 'required',
            'price' => 'required',
            'DOP' => '',
            'location' => 'required',
            'status' => 'required'
        ]);

        $attribute = [
            'brand' => $validatedData['brand'],
            'length' => $validatedData['length'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['extensionCordID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 23,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Extension-cord.index')
        ->with('success', 'Extension Cord added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptId)
    {
        $cord = UitInventory::findOrFail(Crypt::decryptString($encryptId));
        $cord->attribute = json_decode($cord->attribute);
        return view('Admin.AdminUIT.crud.hardware.extension_cord.extension-cord-details', compact('cord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $cord = UitInventory::with('subcategory.category')->findOrFail(Crypt::decryptString($encryptId));
        $cord->attribute = json_decode($cord->attribute);
        $category = $cord->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.extension_cord.edit-extension-cord', compact('cord', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'extensionCordID' => 'required|unique:uit_inventories,name,' . $id,
            'brand' => 'required',
            'length' => 'required',
            'price' => 'required',
            'DOP' => '',
            'location' => 'required',
            'status' => 'required'
        ]);

        $attribute = [
            'brand' => $validatedData['brand'],
            'length' => $validatedData['length'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['extensionCordID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 23,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Extension-cord.index')
        ->with('success', 'Extension Cord updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.extensionCordTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Extension Cord deleted successfully'
        ]);
    }
}
