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

    public function getQuantity(string $id)
    {
        try {
           $quantity = UkwInventory::where('id', $id)->select('current_quantity', 'subcategory_id')->first();

           return response()->json([
                'quantity' => $quantity->current_quantity,
                'subcategory' => $quantity->subcategory_id
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Please Try Again']);
        }
    }

    public function updateQuantity(Request $request, string $id)
    {
        $quantity = $request->input('quantity');
        $subcategory = $request->input('subcategory');

        UkwInventory::where('id', $id)->update(['current_quantity' => $quantity]);
        $query = UkwInventory::query();

        $table = $this->tableCategory($subcategory);

        $data = $this->FilterSearch($query, 7, $subcategory);

        return response()->json([
            'table' => view($table, compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
        ]);
    }

    private function tableCategory($subcategory)
    {
        switch ($subcategory) {
            case 18:
                $table = 'Admin.AdminUKW.table.paperTable';
                break;

            case 19:
                $table = 'Admin.AdminUKW.table.paperTable';
                break;

            case 20:
                $table = 'Admin.AdminUKW.table.stationeryTable';
                break;

            case 22:
                $table = 'Admin.AdminUKW.table.a4paperTable';
                break;

            default:
                abort(404);
                break;
        }

        return $table;
    }

    public function FilterSearch($query, $perPage, $subcategory)
    {
        $query->where('subcategory_id', '=', $subcategory);

        // Apply pagination
        return $query->paginate($perPage);
    }
}
