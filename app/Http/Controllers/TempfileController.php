<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class TempfileController extends Controller
{

    public function  tmpSupplyUpload(Request $request)
    {
         if($request->hasFile('image')) {
            $folder = uniqid('supply', true);

            foreach ($request->file('image') as $image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('supply/tmp/' . $folder, $file_name);

                TemporaryFile::create([
                    'parent_folder' => 'supply',
                    'folder' => $folder,
                    'file' => $file_name
                ]);
            }

            return $folder;
        }

        return '';
    }

    public function tmpSupplyDelete(Request $request)
    {
        $tmp_file = TemporaryFile::where('folder', $request->getContent())->first();
        if($tmp_file){
            Storage::deleteDirectory('supply/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response('');
        }
    }
}
