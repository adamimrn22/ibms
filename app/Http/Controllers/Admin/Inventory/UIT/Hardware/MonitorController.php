<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Status;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\MonitorFilterTraits;

class MonitorController extends Controller
{
    use MonitorFilterTraits,  StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.Hardware.monitorTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.hardware.monitor.view-all-monitor', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.hardware.monitor.create-monitor', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'monitorID' => 'required|unique:uit_inventories,name',
            'monitorBrand' => 'required',
            'monitorModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'display' => 'required',
            'dimension' => 'required',
            'resolution' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);
        $attribute = [
            'brand' => $validatedData['monitorBrand'],
            'model' => $validatedData['monitorModel'],
            'display' => $validatedData['display'],
            'dimension' => $validatedData['dimension'],
            'resolution' => $validatedData['resolution'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['monitorID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 3,
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'created_at' => now()
        ]);

        return redirect()->route('uit.Monitor.index')
        ->with('success', 'Monitor added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $monitor = UitInventory::findOrFail($id);

        // location based name eg desktop name
        $location = UitInventory::select('name', 'id', 'subcategory_id')->where('name', '=', $monitor->location)->first();

        $monitor->attribute = json_decode($monitor->attribute);

        return view('Admin.AdminUIT.crud.hardware.monitor.monitor-details', compact('monitor', 'location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decryptString($encryptId);
        $monitor = UitInventory::with('subcategory.category')->findOrFail($id);
        $monitor->attribute = json_decode($monitor->attribute);
        $category = $monitor->subcategory->category;

        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.monitor.edit-monitor', compact('monitor', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'monitorID' => 'required|unique:uit_inventories,name,'. $id,
            'monitorBrand' => 'required',
            'monitorModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'display' => 'required',
            'dimension' => 'required',
            'resolution' => 'required',
            'DOP' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'brand' => $validatedData['monitorBrand'],
            'model' => $validatedData['monitorModel'],
            'display' => $validatedData['display'],
            'dimension' => $validatedData['dimension'],
            'resolution' => $validatedData['resolution'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['monitorID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'price' => $validatedData['price'],
            'updated_at' => now()
        ]);

        return redirect()->route('uit.Monitor.index')
        ->with('success', 'Monitor updated successfully!');
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
            'table' => view('Admin.AdminUIT.table.Hardware.monitorTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Monitor deleted successfully'
        ]);
    }
}
