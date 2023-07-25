<?php

namespace App\Http\Controllers\Admin\Inventory\UKW;

use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Admin\Filters\UKW\StationeryFilterTraits;
use Illuminate\Support\Facades\Storage;

class StationeryController extends Controller
{
    use StationeryFilterTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UkwInventory::query();

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUKW.table.stationeryTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUKW.crud.stationery.view-all-stationery', compact('data'));
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $stationery = UkwInventory::with('images')->where('id', $id)->first();
            Storage::deleteDirectory('supply/' .$stationery->images->parent_folder);
            $stationery->delete();

            $query = UkwInventory::query();
            $data = $this->applyPaginationFilterSearch($query, 7, '', '');

            return response()->json([
                'table' => view('Admin.AdminUKW.table.stationeryTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'Stationery Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
