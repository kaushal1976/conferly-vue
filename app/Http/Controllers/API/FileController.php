<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function storeConferenceImage(Request $request)
    {
            try {
                $path = $request->file('image')->store('public/conference/images');
                return $path;
            } catch (\Exception $exception) {
                abort(403, $exception->getMessage());
            }
    
    }

    public function storeImage(Request $request) {


    }

}