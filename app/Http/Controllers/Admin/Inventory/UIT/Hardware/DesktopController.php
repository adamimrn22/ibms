<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UitInventory;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\DesktopFilterTraits;

class DesktopController extends Controller
{
    use DesktopFilterTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UitInventory::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUIT.table.Hardware.desktopTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.desktop.view-all-desktop', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $monitors = UitInventory::where('subcategory_id', 3)->select('name','attribute->model as model')->get();
        return view('Admin.AdminUIT.crud.hardware.desktop.create-desktop', compact('monitors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'desktopID' => 'required|unique:uit_inventories,name',
            'desktopModel' => 'required',
            'location' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'keyboard' => 'required',
            'mouse' => 'required',
            'monitor' => 'required',
        ]);

        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));
        $validatedData['monitor'] = json_encode(array_filter($validatedData['monitor']));

        $attribute = [
            'model' => $validatedData['desktopModel'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'keyboard' => $validatedData['keyboard'],
            'mouse' => $validatedData['mouse'],
            'storage' => $validatedData['storage'],
            'monitor' => $validatedData['monitor']
        ];

        UitInventory::create([
            'name' => $validatedData['desktopID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 1,
            'status' => 'GOOD',
            'created_at' => now()
        ]);

        return redirect()->route('uit.Desktop.index')
        ->with('success', 'Desktop added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $desktop = UitInventory::findOrFail($id);
        $desktop->attribute = json_decode($desktop->attribute);
        $desktop->attribute->storage = json_decode($desktop->attribute->storage);
        $desktop->attribute->monitor = json_decode($desktop->attribute->monitor);

        return view('Admin.AdminUIT.crud.hardware.desktop.desktop-details', compact('desktop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $desktop = UitInventory::findOrFail($id);
        $desktop->attribute = json_decode($desktop->attribute);
        $desktop->attribute->storage = json_decode($desktop->attribute->storage);
        $desktop->attribute->monitor = json_decode($desktop->attribute->monitor);
        $monitors = UitInventory::where('subcategory_id', 3)->select('name','attribute->model as model')->get();

        return view('Admin.AdminUIT.crud.hardware.desktop.edit-desktop', compact('desktop', 'monitors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'desktopID' => 'required|unique:uit_inventories,name,' . $id,
            'desktopModel' => 'required',
            'location' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'keyboard' => 'required',
            'mouse' => 'required',
            'monitor' => 'required',
            'status' => 'required',
        ]);

        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));
        $validatedData['monitor'] = json_encode(array_filter($validatedData['monitor']));

        $attribute = [
            'model' => $validatedData['desktopModel'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'keyboard' => $validatedData['keyboard'],
            'mouse' => $validatedData['mouse'],
            'storage' => $validatedData['storage'],
            'monitor' => $validatedData['monitor']
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['desktopID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status' => $validatedData['status'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Desktop.index')
        ->with('success', 'Desktop Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UitInventory::destroy($id);

        $data = UitInventory::where('subcategory_id', '=', 1)->paginate(7);

        return response()->json([
            'table' => view('Admin.AdminUIT.table.Hardware.desktopTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Desktop deleted successfully'
        ]);
    }
}
