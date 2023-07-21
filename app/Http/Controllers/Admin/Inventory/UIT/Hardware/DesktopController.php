<?php

namespace App\Http\Controllers\Admin\Inventory\UIT\Hardware;

use App\Models\Inventory;
use App\Models\UitInventory;
use Illuminate\Http\Request;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Admin\Filters\UIT\Hardware\DesktopFilterTraits;

class DesktopController extends Controller
{
    use DesktopFilterTraits, StatusTraits;
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
       // Monitors
        $monitors = UitInventory::where('subcategory_id', 3)->where('status_id', 1)->whereNull('parent_id')
        ->select('id', 'name', 'attribute->model as model')
        ->get();

        // Mouse
        $mice = UitInventory::where('subcategory_id', 4)->where('status_id', 1)->whereNull('parent_id')
        ->select('id', 'name', 'attribute->model as model')
        ->get();

        // Keyboard
        $keyboards = UitInventory::where('subcategory_id', 5)->where('status_id', 1)->whereNull('parent_id')
        ->select('id', 'name', 'attribute->model as model')
        ->get();

        return view('Admin.AdminUIT.crud.hardware.desktop.create-desktop', compact('monitors', 'mice', 'keyboards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'desktopID' => 'required|unique:uit_inventories,name',
            'desktopModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'mouse' => '',
            'keyboard' => '',
            'monitor' => '',
        ]);

        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));

        $attribute = [
            'model' => $validatedData['desktopModel'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'storage' => $validatedData['storage'],
        ];

        $desktop = UitInventory::create([
            'name' => $validatedData['desktopID'],
            'attribute' => json_encode($attribute),
            'location' => $validatedData['location'],
            'subcategory_id' => 1,
            'price' =>$validatedData['price'],
            'status_id' => 1,
            'created_at' => now()
        ]);

        // for keyboard
        if(isset($validatedData['keyboard'])) {
            UitInventory::where('id', $validatedData['keyboard'])->update([
                'parent_id' => $desktop->id,
                'location' => $validatedData['location'],
            ]);
        }
        // for mouse
        if(isset($validatedData['mouse'])) {
            UitInventory::where('id', $validatedData['mouse'])->update([
                'parent_id' => $desktop->id,
                'location' => $validatedData['location'],
            ]);
        }

        // for monitor
        if (isset($validatedData['monitor'])) {
            if (is_array($validatedData['monitor'])) {
                // If multiple monitors are selected, update each one
                foreach ($validatedData['monitor'] as $monitorId) {
                    UitInventory::where('id', $monitorId)->update([
                        'parent_id' => $desktop->id,
                        'location' => $validatedData['location'],
                    ]);
                }
            } else {
                // If only one monitor is selected, update it
                UitInventory::where('id', $validatedData['monitor'][0])->update([
                    'parent_id' => $desktop->id,
                    'location' => $validatedData['location'],
                ]);
            }
        }

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

        $desktop->attribute->monitor = $desktop->children()->where('subcategory_id', 3)->select('id', 'name')->get();
        $desktop->attribute->mouse = $desktop->children()->where('subcategory_id', 4)->select('id', 'name')->first();
        $desktop->attribute->keyboard = $desktop->children()->where('subcategory_id', 5)->select('id', 'name')->first();

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

        $desktop->attribute->mouse = $desktop->children()->where('subcategory_id', 4)->select('id', 'name', 'attribute->model as model')->first();
        $desktop->attribute->keyboard = $desktop->children()->where('subcategory_id', 5)->select('id', 'name', 'attribute->model as model')->first();
        $desktop->attribute->monitor = $desktop->children()->where('subcategory_id', 3)->select('id', 'name', 'attribute->model as model')->get();

        $monitors = UitInventory::where('subcategory_id', 3)
            ->where('status_id', 1)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', $id)
                    ->orWhereNull('parent_id');
            })
            ->select('id', 'name', 'attribute->model as model')
            ->get();

        $mice = UitInventory::where('subcategory_id', 4)
            ->where('status_id', 1)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', $id)
                    ->orWhereNull('parent_id');
             })
            ->select('id', 'name', 'attribute->model as model')
            ->get();

        $keyboards = UitInventory::where('subcategory_id', 5)
            ->where('status_id', 1)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', $id)
                    ->orWhereNull('parent_id');
             })
            ->select('id', 'name', 'attribute->model as model')
            ->get();

        $category = $desktop->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUIT.crud.hardware.desktop.edit-desktop', compact('desktop', 'monitors', 'mice', 'keyboards', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'desktopID' => 'required|unique:uit_inventories,name,' . $id,
            'desktopModel' => 'required',
            'price' => 'required|between:0,99.99',
            'location' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'OS' => 'required',
            'gpu' => 'required',
            'storage' => 'required',
            'mouse' => '',
            'keyboard' => '',
            'monitor' => '',
            'status' => 'required',
        ]);

        $parents = UitInventory::where('parent_id', $id)->get();
        foreach ($parents as $parent) {
            $parent->parent_id = NULL;
            $parent->save();
        }

        $validatedData['storage'] = json_encode(array_filter($validatedData['storage']));

        $attribute = [
            'model' => $validatedData['desktopModel'],
            'processor' => $validatedData['processor'],
            'ram' => $validatedData['ram'],
            'OS' => $validatedData['OS'],
            'gpu' => $validatedData['gpu'],
            'storage' => $validatedData['storage'],
        ];

        UitInventory::where('id', $id)->update([
            'name' => $validatedData['desktopID'],
            'attribute' => json_encode($attribute),
            'price' =>$validatedData['price'],
            'location' => $validatedData['location'],
            'status_id' => $validatedData['status'],
            'updated_at' => now()
        ]);

        // for keyboard
        if(isset($validatedData['keyboard'])) {
            UitInventory::where('id', $validatedData['keyboard'])->update([
                'parent_id' => $id,
                'location' => $validatedData['location'],
            ]);
        }
        // for mouse
        if(isset($validatedData['mouse'])) {
            UitInventory::where('id', $validatedData['mouse'])->update([
                'parent_id' => $id,
                'location' => $validatedData['location'],
            ]);
        }

        // for monitor
        if (isset($validatedData['monitor'])) {
            if (is_array($validatedData['monitor'])) {
                // If multiple monitors are selected, update each one
                foreach ($validatedData['monitor'] as $monitorId) {
                    UitInventory::where('id', $monitorId)->update([
                        'parent_id' => $id,
                        'location' => $validatedData['location'],
                    ]);
                }
            } else {
                // If only one monitor is selected, update it
                UitInventory::where('id', $validatedData['monitor'][0])->update([
                    'parent_id' => $id,
                    'location' => $validatedData['location'],
                ]);
            }
        }

        return redirect()->route('uit.Desktop.index')
        ->with('success', 'Desktop Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parents = UitInventory::where('parent_id', $id)->get();

        foreach ($parents as $parent) {
            $parent->parent_id = NULL;
            $parent->save();

        }
        UitInventory::destroy($id);

        $data = UitInventory::where('subcategory_id', '=', 1)->paginate(7);

        return response()->json([
            'table' => view('Admin.AdminUIT.table.Hardware.desktopTable', compact('data'))->render(),
            'pagination' => view('components.Pagination', compact('data'))->render(),
            'success' => 'Desktop deleted successfully'
        ]);
    }
}
