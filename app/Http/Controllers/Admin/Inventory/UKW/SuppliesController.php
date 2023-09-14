<?php

namespace App\Http\Controllers\Admin\Inventory\UKW;

use Illuminate\Support\Str;
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
        $subcategories = $this->Subcategory(7);
        $statuses = $this->status(7);
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
            'subcategory_id' => 'required',
            'status_id' => 'required'
        ]);

        list($id, $name) = explode('|', $validatedData['subcategory_id']);
        $validatedData['subcategory_id'] = $id;

        $validatedData['created_at'] = now();

        try {
            $tmp_file = TemporaryFile::where('parent_folder', 'supply')->first();

            if($tmp_file) {

                $cleanedFileName =  Str::slug($validatedData['name']);
                Storage::copy('supply/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'supply/'. $cleanedFileName . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                $supply = UkwInventory::create($validatedData);

                UkwInventoryImage::create([
                    'inventories_id' => $supply->id,
                    'parent_folder' => $cleanedFileName,
                    'path' => $tmp_file->folder . '/' . $tmp_file->file
                ]);

                Storage::deleteDirectory('supply/tmp/');
                $tmp_file->delete();
            }
            return redirect()->route('ukw.' .$name . '.index')->with('success', $name . ' Created');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage(); // Get the error message
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $supply = UkwInventory::with('images', 'status')->findOrFail($id);
        return view('Admin.AdminUKW.crud.supply.supply-details', compact('supply'));
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
                $cleanedFileName =  Str::slug($validatedData['name']);

                $images = UkwInventoryImage::where('inventories_id', $id)->first();
                Storage::deleteDirectory('supply/' .$images->parent_folder);
                UkwInventoryImage::where('inventories_id', $id)->delete();

                Storage::copy('supply/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'supply/'. $cleanedFileName . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                UkwInventoryImage::create([
                    'inventories_id' => $id,
                    'parent_folder' => $cleanedFileName,
                    'path' => $tmp_file->folder . '/' . $tmp_file->file
                ]);

                Storage::deleteDirectory('supply/tmp/');
                $tmp_file->delete();
            }
            return redirect()->route('ukw.' .$name . '.index')->with('success', $name . ' Updated');
        }catch (\Throwable $th) {
            $errorMessage = $th->getMessage(); // Get the error message
            return redirect()->back()->with('error', strval($errorMessage));
        }
    }

    public function getQuantity(string $id)
    {
        try {
           $quantity = UkwInventory::where('id', $id)->select('current_quantity', 'subcategory_id')->first();

           return response()->json([
                'quantity' => $quantity->current_quantity,
                'subcategory' => $quantity->subcategory_id
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function updateQuantity(Request $request, string $id)
    {
        $quantity = $request->input('quantity');
        $subcategory = $request->input('subcategory');

        UkwInventory::where('id', $id)->update(['current_quantity' => $quantity]);
        $query = UkwInventory::query();

        $tableCategory = $this->tableCategory($subcategory);

        $data = $this->FilterSearch($query, 7, $subcategory);

        return response()->json([
            'table' => view($tableCategory->table, compact('data'))->render(),
            'idTable' => $tableCategory->id,
            'success' => 'Quantity Successfully Updated',
            'pagination' => view('components.Pagination', compact('data'))->render(),
        ]);
    }

    private function tableCategory($subcategory)
    {
        switch ($subcategory) {
            case 18:
                $table = 'Admin.AdminUKW.table.paperTable';
                $idTable = 'paperTable';
                break;

            case 19:
                $table = 'Admin.AdminUKW.table.fileTable';
                $idTable = 'fileTable';
                break;

            case 20:
                $table = 'Admin.AdminUKW.table.stationeryTable';
                $idTable = 'stationeryTable';
                break;

            case 22:
                $table = 'Admin.AdminUKW.table.a4paperTable';
                $idTable = 'paperTable';
                break;

            default:
                abort(404);
                break;
        }

        return (object) [
           'table' => $table,
           'id' => $idTable
        ];
    }

    public function FilterSearch($query, $perPage, $subcategory)
    {
        $query->where('subcategory_id', '=', $subcategory);

        // Apply pagination
        return $query->paginate($perPage);
    }
}
