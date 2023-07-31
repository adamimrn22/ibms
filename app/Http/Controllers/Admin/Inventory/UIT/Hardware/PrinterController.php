<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Support\ValidatedData;
use App\Traits\Admin\Filters\UIT\Hardware\PrinterFilterTraits;

class PrinterController extends Controller
{
    use PrinterFilterTraits, StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.printerTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.printer.view-all-printer', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.printer.create-printer', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'printerID' => 'required|unique:uit_inventories,name',
            'price' => 'required',
            'printerBrand' => 'required',
            'printerModel' => 'required',
            'location' => 'required',
            'tonerBlack' => 'required',
            'tonerColor' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['printerBrand'],
            'model' => $validatedData['printerModel'],
            'tonerBlack' => $validatedData['tonerBlack'],
            'tonerColor' => $validatedData['tonerColor'],
            'weight' => $validatedData['weight'],
            'tonerColor' => $validatedData['tonerColor'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['printerID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 6,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Printer.index')
        ->with('success', 'Printer added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $printer = UitInventory::findOrFail($id);
        $printer->attribute = json_decode($printer->attribute);

        return view('Admin.AdminUIT.crud.hardware.printer.printer-details', compact('printer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $printer = UitInventory::with('subcategory.category')->findOrFail($id);
        $printer->attribute = json_decode($printer->attribute);
        $category = $printer->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.printer.edit-printer', compact('printer', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'printerID' => 'required|unique:uit_inventories,name,' . $id,
            'price' => 'required',
            'printerBrand' => 'required',
            'printerModel' => 'required',
            'location' => 'required',
            'tonerBlack' => 'required',
            'tonerColor' => 'required',
            'weight' => 'required',
            'color' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['printerBrand'],
            'model' => $validatedData['printerModel'],
            'tonerBlack' => $validatedData['tonerBlack'],
            'tonerColor' => $validatedData['tonerColor'],
            'weight' => $validatedData['weight'],
            'tonerColor' => $validatedData['tonerColor'],
            'color' => $validatedData['color'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['printerID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Printer.index')
        ->with('success', 'Printer updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.printerTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Printer deleted successfully'
        ]);
    }
}
