<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;

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
            'file' => 'required|image|mimes:jpeg,bmp,png|size:10000'
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
        //
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
        //
    }
}
