<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Cable;

use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UIT\Cable\CableFilterTraits;

class UsbController extends Controller
{
    use CableFilterTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UitInventory::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, 12, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUIT.table.cable.usbTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUIT.crud.cable.view-all-usb', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = UitInventory::query();
        UitInventory::destroy($id);

        $data = $this->applyPaginationFilterSearch($query, 12, 7, '', '');
        return response()->json([
            'table' => view('Admin.AdminUIT.table.cable.usbTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Usb Cable deleted successfully'
        ]);
    }
}
