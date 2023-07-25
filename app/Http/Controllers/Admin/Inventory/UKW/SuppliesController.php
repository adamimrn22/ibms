<?php

namespace App\Http\Controllers\Admin\Inventory\UKW;

use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\UkwInventoryImage;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\SubcategoryTraits;
use Illuminate\Support\Facades\Storage;

class SuppliesController extends Controller
{

    use StatusTraits, SubcategoryTraits;

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = $this->Subcategory(6);
        $statuses = $this->status(6);
        return view('Admin.AdminUKW.crud.supply.create-supply', compact('statuses', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:ukw_inventories,name',
            'current_quantity' => 'required',
            'stock' => 'required',
            'subcategory_id' => 'required',
            'status_id' => 'required'
        ]);

        list($id, $name) = explode('|', $validatedData['subcategory_id']);
        $validatedData['subcategory_id'] = $id;

        $validatedData['created_at'] = now();

        try {
            $supply = UkwInventory::create($validatedData);

            $tmp_file = TemporaryFile::where('parent_folder', 'supply')->first();

            if($tmp_file) {
                Storage::copy('supply/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'supply/'. str_replace(' ', '_', $validatedData['name']) . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                UkwInventoryImage::create([
                    'inventories_id' => $supply->id,
                    'parent_folder' => str_replace(' ', '_', $validatedData['name']),
                    'path' => $tmp_file->folder . '/' . $tmp_file->file
                ]);

                Storage::deleteDirectory('supply/tmp/');
                $tmp_file->delete();
            }
            return redirect()->route('ukw.' .$name . '.index')->with('success', $name . ' Created');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage(); // Get the error message
            return redirect()->back()->with('error', strval($errorMessage));
        }
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
    public function edit(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $supply = UkwInventory::findOrFail($id);
        $category = $supply->subcategory->category;
        $subcategories = $this->Subcategory($category->id);
        $statuses = $this->status($category->id);
        return view('Admin.AdminUKW.crud.supply.edit-supply', compact('supply', 'statuses', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:ukw_inventories,name,' . $id,
            'current_quantity' => 'required',
            'stock' => 'required',
            'subcategory_id' => 'required',
            'status_id' => 'required'
        ]);

        list($sub_id, $name) = explode('|', $validatedData['subcategory_id']);

        $validatedData['subcategory_id'] = $sub_id;
        $validatedData['updated_at'] = now();

        try {

            UkwInventory::where('id', $id)->update($validatedData);
            $tmp_file = TemporaryFile::where('parent_folder', 'supply')->first();

            if(!empty($tmp_file) ) {
                $images = UkwInventoryImage::where('inventories_id', $id)->first();
                Storage::deleteDirectory('supply/' .$images->parent_folder);
                UkwInventoryImage::where('inventories_id', $id)->delete();

                Storage::copy('supply/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'supply/'. str_replace(' ', '_', $validatedData['name'] ) . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                UkwInventoryImage::create([
                    'inventories_id' => $id,
                    'parent_folder' => str_replace(' ', '_', $validatedData['name'] ),
                    'path' => $tmp_file->folder . '/' . $tmp_file->file
                ]);

                Storage::deleteDirectory('supply/tmp/' . $tmp_file->folder);
                $tmp_file->delete();
            }
            return redirect()->route('ukw.' .$name . '.index')->with('success', $name . ' Updated');
        }catch (\Throwable $th) {
            $errorMessage = $th->getMessage(); // Get the error message
            return redirect()->back()->with('error', strval($errorMessage));
        }
    }


}
