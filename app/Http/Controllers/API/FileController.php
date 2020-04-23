<?php
namespace App\Http\Controllers\API;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function storeConferenceImage(Request $request)
    {
        $validated  = $request->validate([
            'file' => 'required|image'
        ]);

       if ($request->file('file')) {
            try {
                $path = $request->file('file')->store('public/conference/images');
                $file = new File;
                $file->ext = $request->file('file')->extension();
                $file->size = $request->file('file')->getSize();
                $file->name = $path;
                $file->type = $request->file('file')->getClientMimeType();
                $file->save();
            } catch (\Exception $exception) {
                abort(403, $exception->getMessage());
            }
        }else{
            abort(404);
        }
    }

}