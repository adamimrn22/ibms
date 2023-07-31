<?php

namespace App\Http\Controllers\Admin\Inventory\UPSM;

use Illuminate\Http\Request;
use App\Models\UpsmInventory;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UPSM\CarFilterTraits;
use Illuminate\Support\Facades\Crypt;

class CarController extends Controller
{
    use CarFilterTraits, StatusTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UpsmInventory::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.table.carTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.crud.car.view-all-car', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(7);
        return view('Admin.AdminUPSM.crud.car.create-car', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'seat' => 'required',
            'DOP' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'seat' => $validatedData['seat'],
            'DOP' => $validatedData['DOP']
        ];

        UpsmInventory::create([
            'name' => $validatedData['name'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'subcategory_id' => 15,
            'created_at' => now()
        ]);

        return redirect()->route('upsm.Kenderaan.index',)->with('success', 'Car Added Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptedID)
    {
        $id = Crypt::decryptString($encryptedID);
        $car = UpsmInventory::with('status')->findOrFail($id);
        $car->attribute = json_decode($car->attribute);

        return view('Admin.AdminUPSM.crud.car.car-details', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptedID)
    {
        $id = Crypt::decryptString($encryptedID);
        $car = UpsmInventory::findOrFail($id);
        $car->attribute = json_decode($car->attribute);

        $category = $car->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUPSM.crud.car.edit-car', compact('car', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'seat' => 'required',
            'DOP' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'seat' => $validatedData['seat'],
            'DOP' => $validatedData['DOP']
        ];

        UpsmInventory::where('id', $id)->update([
            'name' => $validatedData['name'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'updated_at' => now()
        ]);

        return redirect()->route('upsm.Kenderaan.index',)->with('success', 'Car Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            UpsmInventory::destroy($id);

            $query = UpsmInventory::query();
            $data = $this->applyPaginationFilterSearch($query, 7, '', '');

            return response()->json([
                'table' => view('Admin.AdminUPSM.table.carTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'Car Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
