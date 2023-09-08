<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Others;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class SoftwareController extends Controller
{
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
                'table' => view('Admin.AdminUIT.table.others.softwareTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.others.Software.view-all-software', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.AdminUIT.crud.others.Software.create-software');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'location' => 'required',
            'price' => 'required',
            'details' => 'required'
        ]);

        $attribute = [
            'brand' => $validatedData['brand'],
            'details' => $validatedData['details']
        ];

        UitInventory::create([
            'name' => $validatedData['name'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
            'status_id' => 1,
            'subcategory_id' => 13,
        ]);

        return redirect()->route('uit.Software.index')->with([
            'success' => 'Software Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $software = UitInventory::findOrFail(Crypt::decryptString($id));
        $software->attribute = json_decode($software->attribute);
        return view('Admin.AdminUIT.crud.others.Software.software-details', compact('software'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $software = UitInventory::findOrFail(Crypt::decryptString($id));
        $software->attribute = json_decode($software->attribute);

        return view('Admin.AdminUIT.crud.others.Software.edit-software', compact('software'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'location' => 'required',
            'price' => 'required',
            'details' => 'required'
        ]);

        $attribute = [
            'brand' => $validatedData['brand'],
            'details' => $validatedData['details']
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['name'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('uit.Software.index')->with([
            'success' => 'Software Updated Successfully'
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
            'table' => view('Admin.AdminUIT.table.others.softwareTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Software deleted successfully'
        ]);
    }

    private function applyPaginationFilterSearch($query, $perPage, $searchTerm,  $status)
    {
        $query->where('subcategory_id', '=', 13) ;
        // For search filtering
        if ($searchTerm) {
            $query->where('subcategory_id', '=', 13)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                    ->orWhereRaw("JSON_EXTRACT(attribute, '$.brand') LIKE ?", ["%{$searchTerm}%"]);
                });
        }

        if ($status && $status !== 'ALL') {
            $query->where('status_id', '=', "$status");
        }

        $results = $query->select('name', DB::raw("JSON_UNQUOTE(JSON_EXTRACT(attribute, '$.brand')) AS brand"), 'location', 'status_id', 'id')->paginate($perPage);

        return $results;
    }
}
