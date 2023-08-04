<?php

namespace App\Http\Controllers\Admin\Inventory\UPSM;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\UpsmInventory;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UPSM\OfficeroomFilterTraits;
use Illuminate\Support\Facades\Crypt;

class OfficeRoomController extends Controller
{
    use OfficeroomFilterTraits, StatusTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UpsmInventory::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.table.officeTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.crud.office.view-all-office', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = $this->status(5);
        return view('Admin.AdminUPSM.crud.office.create-office', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'officeName' => 'required',
            'officeLocation' => 'required',
            'Sofa' => 'required',
            'Drawer' => 'required',
            'Chair' => 'required',
            'FoldableChair' => 'required',
            'Table' => 'required',
            'Whiteboard' => 'required',
            'Duster' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'Sofa' => $validatedData['Sofa'],
            'Drawer' => $validatedData['Drawer'],
            'Chair' => $validatedData['Chair'],
            'Foldable_Chair' => $validatedData['FoldableChair'],
            'Table' => $validatedData['Table'],
            'Whiteboard' => $validatedData['Whiteboard'],
            'Duster' => $validatedData['Duster'],
        ];

        UpsmInventory::create([
            'name' => $validatedData['officeName'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['officeLocation'],
            'status_id' => $validatedData['status'],
            'subcategory_id' => 15
        ]);

        return redirect()->route('upsm.Office.index')->with('success', 'Office Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptId)
    {
        $id = Crypt::decrypt($encryptId);
        $office = UpsmInventory::with('status')->findOrFail($id);
        $office->attribute = json_decode($office->attribute);

        return view('Admin.AdminUPSM.crud.office.office-details', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encryptId)
    {
        $id = Crypt::decrypt($encryptId);
        $office = UpsmInventory::findOrFail($id);
        $office->attribute = json_decode($office->attribute);
        $category = $office->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUPSM.crud.office.edit-office', compact('office', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'officeName' => 'required',
            'officeLocation' => 'required',
            'Sofa' => 'required',
            'Drawer' => 'required',
            'Chair' => 'required',
            'FoldableChair' => 'required',
            'Table' => 'required',
            'Whiteboard' => 'required',
            'Duster' => 'required',
            'status' => 'required',
        ]);

        $attribute = [
            'Sofa' => $validatedData['Sofa'],
            'Drawer' => $validatedData['Drawer'],
            'Chair' => $validatedData['Chair'],
            'Foldable_Chair' => $validatedData['FoldableChair'],
            'Table' => $validatedData['Table'],
            'Whiteboard' => $validatedData['Whiteboard'],
            'Duster' => $validatedData['Duster'],
        ];

        UpsmInventory::where('id', $id)->update([
            'name' => $validatedData['officeName'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['officeLocation'],
            'status_id' => $validatedData['status'],
            'updated_at' => now()
        ]);

        return redirect()->route('upsm.Office.index')->with('success', 'Office Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UpsmInventory::destroy($id);

        $query = UpsmInventory::query();
        $data = $this->applyPaginationFilterSearch($query, 7, '', '');

        return response()->json([
            'table' => view('Admin.AdminUPSM.table.officeTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Office Deleted Successfully'
        ]);
    }
}
