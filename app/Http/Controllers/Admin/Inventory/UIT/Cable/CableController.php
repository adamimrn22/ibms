<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Cable;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\SubcategoryTraits;

class CableController extends Controller
{
    use SubcategoryTraits, StatusTraits;
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = $this->Subcategory(2);
        $statuses = $this->status(2);
        return view('Admin.AdminUIT.crud.cable.cable.create-cable', compact('subcategories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cableID' => 'required|unique:uit_inventories,name',
            'price' => 'required',
            'cableName' => 'required',
            'location' => 'required',
            'meter' => 'required',
            'DOP' => 'required',
            'subcategory_id' => 'required',
            'status' => 'required',
        ]);

        list($id, $name) = explode('|', $validatedData['subcategory_id']);
        $validatedData['subcategory_id'] = $id;
        $validatedData['created_at'] = now();

        try {
            $attribute = [
                'cableName' => $validatedData['cableName'],
                'meter' => $validatedData['meter'],
                'DOP' => $validatedData['DOP'],
            ];

            UitInventory::create([
                'name' => $validatedData['cableID'],
                'attribute' => json_encode($attribute),
                'location' => $validatedData['location'],
                'subcategory_id' => $validatedData['subcategory_id'],
                'status_id' => $validatedData['status'],
                'price' => $validatedData['price'],
                'created_at' => now()
            ]);

            return redirect()->route('uit.' . ucfirst(strtolower($name)) . '.index')->with('success', ucfirst(strtolower($name)) . ' Succesfully Created');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage(); // Get the error message
            return redirect()->back()->with('error', strval($errorMessage));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $cable = UitInventory::with('subcategory.category')->findOrFail($id);
        $cable->attribute = json_decode($cable->attribute);
        $category = $cable->subcategory->category;
        $subcategories = $this->Subcategory($category->id);
        $statuses = $this->status($category->id);

        return view('Admin.AdminUIT.crud.cable.cable.edit-cable', compact('cable', 'statuses', 'subcategories'));
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
