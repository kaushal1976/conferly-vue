<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function storeConferenceImage(Request $request)
    {
        if ($request->file('file')) {
            try {
                $path = $request->file('file')->store('public/conference/images');
                return $path;
            } catch (\Exception $exception) {
                abort(403, $exception->getMessage());
            }
        }else{
            return $request->image;
        }
    }

    public function storeImage(Request $request) {


    }

}