<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;

class ConferenceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'file' => 'required|image|mimes:jpeg,bmp,png'
        ]);

        if ($request->file('file')) {
            try {
                $path = $request->file('file')->store('public/conference/images');
                $file = new File;
                $file->ext = $request->file('file')->extension();
                $file->size = $request->file('file')->getSize();
                $file->name = $path;
                $file->type = $request->file('file')->getClientMimeType();
                $file->recordId = $request->id;
                $file->save();
                return $file;
                
            } catch (\Exception $exception) {
                abort(403, $exception->getMessage());
            }
        } else {
             abort(404,"File not found");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::findOrFail($id);
        return response()->json($file->url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if (Storage::exists($file->name)) {
            Storage::delete($file->name);
        } else {
            abort(404, 'File not found');
        }
        $file->delete();
        return response()->json('Deleted');
    }

    public function download($id) {
        $file = File::findOrFail($id);
        return Storage::download($file->name);
    }
}
