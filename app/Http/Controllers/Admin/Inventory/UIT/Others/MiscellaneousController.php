<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Others;

use software;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class MiscellaneousController extends Controller
{
    use  StatusTraits;
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
                'table' => view('Admin.AdminUIT.table.others.miscellaneousTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.others.Miscellaneous.view-all-miscellaneous', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(1);
        return view('Admin.AdminUIT.crud.others.Miscellaneous.create-miscellaneous', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'assetID' => 'required|unique:uit_inventories,name',
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'location' => 'required',
            'price' => 'required',
            'DOP' => 'required',
            'status' => 'required'
        ]);

        $attribute = [
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::create([
            'name' => $validatedData['assetID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
            'status_id' => $validatedData['status'],
            'subcategory_id' => 13,
        ]);

        return redirect()->route('uit.Miscellaneous.index')->with([
            'success' => 'Miscellaneous Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $misc = UitInventory::with('status')->findOrFail(Crypt::decryptString($id));
        $misc->attribute = json_decode($misc->attribute);
        return view('Admin.AdminUIT.crud.others.Miscellaneous.miscellaneous-details', compact('misc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $misc = UitInventory::findOrFail(Crypt::decryptString($id));
        $statuses = $this->status(1);
        $misc->attribute = json_decode($misc->attribute);

        return view('Admin.AdminUIT.crud.others.Miscellaneous.edit-miscellaneous', compact('misc', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'assetID' => 'required|unique:uit_inventories,name,' . $id,
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'location' => 'required',
            'price' => 'required',
            'DOP' => 'required',
            'status' => 'required'
        ]);

        $attribute = [
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'],
            'DOP' => $validatedData['DOP'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['assetID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
            'status_id' => $validatedData['status'],
        ]);

        return redirect()->route('uit.Miscellaneous.index')->with([
            'success' => 'Miscellaneous Updated Successfully'
        ]);
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
            'table' => view('Admin.AdminUIT.table.others.miscellaneousTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Miscellaneous deleted successfully'
        ]);
    }

    private function applyPaginationFilterSearch($query, $perPage, $searchTerm,  $status)
    {
        $query->where('subcategory_id', '=', 14) ;
        // For search filtering
        if ($searchTerm) {
            $query->where('subcategory_id', '=', 14)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                        ->orWhereRaw("JSON_EXTRACT(attribute, '$.model') LIKE ?", ["%{$searchTerm}%"])
                        ->orWhereRaw("JSON_EXTRACT(attribute, '$.brand') LIKE ?", ["%{$searchTerm}%"]);
                    });
        }

        if ($status && $status !== 'ALL') {
            $query->where('status_id', '=', "$status");
        }

        $results = $query->select('name', DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.brand')) AS brand"), DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.model')) AS model"), DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.name')) AS itemName"), 'location', 'status_id', 'id')->paginate($perPage);

        return $results;
    }
}
