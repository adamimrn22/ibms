<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Status;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\LaptopFilterTraits;

class LaptopController extends Controller
{
    use LaptopFilterTraits, StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.laptopTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.laptop.view-all-laptop', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.laptop.create-laptop', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'laptopID' => 'required|unique:uit_inventories,name',
            'laptopBrand' => 'required',
            'laptopModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'display' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));

        $attribute = [
            'brand' => $validatedData['laptopBrand'],
            'model' => $validatedData['laptopModel'],
            'display' => $validatedData['display'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'storage' => $validatedData['storage'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['laptopID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 2,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Laptop.index')
        ->with('success', 'Laptop added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $laptop = UitInventory::findOrFail($id);
        $laptop->attribute = json_decode($laptop->attribute);
        $laptop->attribute->storage = json_decode($laptop->attribute->storage);

        return view('Admin.AdminUIT.crud.hardware.laptop.laptop-details', compact('laptop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $laptop = UitInventory::with('subcategory.category')->findOrFail($id);
        $laptop->attribute = json_decode($laptop->attribute);
        $laptop->attribute->storage = json_decode($laptop->attribute->storage);
        $category = $laptop->subcategory->category;

        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.laptop.edit-laptop', compact('laptop', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'laptopID' => 'required|unique:uit_inventories,name,' . $id,
            'laptopBrand' => 'required',
            'laptopModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'display' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);
        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));

        $attribute = [
            'brand' => $validatedData['laptopBrand'],
            'model' => $validatedData['laptopModel'],
            'display' => $validatedData['display'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'storage' => $validatedData['storage'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['laptopID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
            'status_id' => $validatedData['status'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Laptop.index')
        ->with('success', 'Laptop updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.laptopTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Laptop deleted successfully'
        ]);
    }
}
