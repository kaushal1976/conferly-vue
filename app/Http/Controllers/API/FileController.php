<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function image(Request $request)
    {
        $path = storage_path('app/' . $request->image);
        if (file_exists($path)) {
            return response()->file($path, array('Content-Type' => 'image/jpeg'));
        }else{
            abort(404);
        }
        
    }

    public function storeFile(Request $request)
    {
            try {
                $path = $request->file('file')->store($request->location);
                return $path;
            } catch (\Exception $exception) {
                abort(403, $exception->getMessage());
            }
    
    }

}