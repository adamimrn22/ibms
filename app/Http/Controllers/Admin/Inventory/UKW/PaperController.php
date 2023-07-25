<?php

namespace App\Http\Controllers\Admin\Inventory\UKW;

use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\UkwInventoryImage;
use Illuminate\Support\Facades\Storage;
use App\Traits\Admin\Filters\UKW\PaperFilterTraits;
use App\Traits\Admin\SubcategoryTraits;
use Illuminate\Support\Facades\Crypt;

class PaperController extends Controller
{
    use PaperFilterTraits;
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
                'table' => view('Admin.AdminUKW.table.paperTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUKW.crud.paper.view-all-paper', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $paper = UkwInventory::with('images')->where('id', $id)->first();
            Storage::deleteDirectory('supply/' .$paper->images->parent_folder);
            $paper->delete();

            $query = UkwInventory::query();
            $data = $this->applyPaginationFilterSearch($query, 7, '', '');

            return response()->json([
                'table' => view('Admin.AdminUKW.table.paperTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'Paper Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

}
