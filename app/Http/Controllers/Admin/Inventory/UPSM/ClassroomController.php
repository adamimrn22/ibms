<?php

namespace App\Http\Controllers\Admin\Inventory\UPSM;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\UpsmInventory;
use App\Models\ClassroomImage;
use App\Traits\Admin\StatusTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Traits\Admin\Filters\UPSM\ClassroomFilterTraits;
use App\Http\Requests\Admin\Inventory\UPSM\addClassroomRequest;
use App\Http\Requests\Admin\Inventory\UPSM\editClassroomRequest;
use Illuminate\Support\Facades\Crypt;

class ClassroomController extends Controller
{
    use ClassroomFilterTraits, StatusTraits;

    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UpsmInventory::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.crud.classroom.view-all-classroom', compact('data'));
    }

    public function create()
    {
        $statuses = $this->status(5);
        return view('Admin.AdminUPSM.crud.classroom.create-classroom', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'className' => 'required',
            'classLocation' => 'required',
            'classChair' => 'required',
            'classFoldableChair' => 'required',
            'classTable' => 'required',
            'classWhiteboard' => 'required',
            'classDuster' => 'required',
            'status' => 'required',
        ]);

        try {

            $attribute = [
                'Chair' => $validatedData['classChair'],
                'Foldable_Chair' => $validatedData['classFoldableChair'],
                'Table' => $validatedData['classTable'],
                'Whiteboard' => $validatedData['classWhiteboard'],
                'Duster' => $validatedData['classDuster'],
            ];

            $classroom = UpsmInventory::create([
                'name' => $validatedData['className'],
                'attribute' => json_encode($attribute),
                'location' => $validatedData['classLocation'],
                'status_id' => $validatedData['status'],
                'subcategory_id' => 12
            ]);

            $tmp_files = TemporaryFile::where('parent_folder', 'classroom')->get();

            if($tmp_files) {
                foreach ($tmp_files as $tmp_file) {
                    Storage::copy('classroom/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'classroom/'. str_replace(' ', '_', $validatedData['className'] ) . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                    ClassroomImage::create([
                        'classroom_id' => $classroom->id,
                        'parent_folder' => str_replace(' ', '_', $validatedData['className'] ),
                        'path' => $tmp_file->folder . '/' . $tmp_file->file
                    ]);

                    Storage::deleteDirectory('classroom/tmp/' . $tmp_file->folder);
                    $tmp_file->delete();
                }
            }

            return redirect()->route('upsm.Classroom.index')->with('success', 'Classroom Created');
        } catch (\Throwable $th) {
            return redirect()->route('upsm.Classroom.index')->with('error', $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $encryptID)
    {
        $id = Crypt::decrypt($encryptID);
        $classroom = UpsmInventory::with('images', 'status')->where('id', $id)->first();
        $classroom->attribute = json_decode($classroom->attribute);
        return view('Admin.AdminUPSM.crud.classroom.classroom-details', compact('classroom'));
    }

    public function edit(string $encryptID)
    {

        $id = Crypt::decrypt($encryptID);
        $classroom = UpsmInventory::with('subcategory.category')->findOrFail($id);
        $classroom->attribute = json_decode($classroom->attribute);
        $category = $classroom->subcategory->category;
        $statuses = $this->status($category->id);
        return view('Admin.AdminUPSM.crud.classroom.edit-classroom', compact('classroom', 'statuses'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'className' => 'required',
                'classLocation' => 'required',
                'classChair' => 'required',
                'classFoldableChair' => 'required',
                'classTable' => 'required',
                'classWhiteboard' => 'required',
                'classDuster' => 'required',
                'status' => 'required',
            ]);

            $attribute = [
                'Chair' => $validatedData['classChair'],
                'Foldable_Chair' => $validatedData['classFoldableChair'],
                'Table' => $validatedData['classTable'],
                'Whiteboard' => $validatedData['classChair'],
                'Duster' => $validatedData['classChair'],
            ];

            UpsmInventory::where('id', $id)->update([
                'name' => $validatedData['className'],
                'attribute' => json_encode($attribute),
                'location' => $validatedData['classLocation'],
                'status_id' => $validatedData['status']
            ]);

            $tmp_files = TemporaryFile::where('parent_folder', 'classroom')->get();

            if(!$tmp_files->isEmpty() ) {
                $images = ClassroomImage::where('classroom_id', $id)->get();
                Storage::deleteDirectory('classroom/' .$images[0]->parent_folder);
                ClassroomImage::where('classroom_id', $id)->delete();

                foreach ($tmp_files as $tmp_file) {
                    Storage::copy('classroom/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'classroom/'. str_replace(' ', '_', $validatedData['className'] ) . '/' . $tmp_file->folder . '/' . $tmp_file->file);

                    ClassroomImage::create([
                        'classroom_id' => $id,
                        'parent_folder' => str_replace(' ', '_', $validatedData['className'] ),
                        'path' => $tmp_file->folder . '/' . $tmp_file->file
                    ]);

                    Storage::deleteDirectory('classroom/tmp/' . $tmp_file->folder);
                    $tmp_file->delete();
                }
            }

            return redirect()->route('upsm.Classroom.index')->with('success', 'Classroom Updated');
        }catch (\Throwable $th) {
            return redirect()->route('upsm.Classroom.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classroom = UpsmInventory::with('images')->where('id', $id)->first();
            Storage::deleteDirectory('classroom/' .$classroom->images[0]->parent_folder);
            $classroom->delete();

            $query = UpsmInventory::query();
            $data = $this->applyPaginationFilterSearch($query, 7, '', '');

            return response()->json([
                'table' => view('Admin.AdminUPSM.table.classroomTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
                'success' => 'Classroom Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function tmpUpload(Request $request)
    {
         if($request->hasFile('image')) {
            $folder = uniqid('classroom', true);

            foreach ($request->file('image') as $image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('classroom/tmp/' . $folder, $file_name);

                TemporaryFile::create([
                    'parent_folder' => 'classroom',
                    'folder' => $folder,
                    'file' => $file_name
                ]);
            }

            return $folder;
        }

        return '';
    }

    public function tmpDelete(Request $request)
    {
        $tmp_file = TemporaryFile::where('folder', $request->getContent())->first();
        if($tmp_file){
            Storage::deleteDirectory('classroom/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response('');
        }
    }
}
