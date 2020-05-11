<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Conference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConferenceController extends Controller
{
    /*
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index', 'show', 'displayImage', 'edit', 'store', 'update', 'destroy'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::all();
        return response()->json($conferences);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:conferences|max:255',
            'description'=>'required',
            'venue'=>'required|max:255',
            'tag_line'=>'required|max:255',
            'subject_area'=>'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
        ]);
        $validatedData['image'] = 'da7dd6bb339a234cb0c7c12a5b75a91f.jpg';
        try {
            $conference = Conference::create($validatedData);
                if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/conference/images');
                $conference->image = basename($path);
                $conference->save();
                }
        } catch (\Exception $exception) {
            abort(403, $exception->getMessage());
        }
        return response()->json($conference);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::with(['themes','themes.themeLeaders', 'themes.themeLeaders.user'])->findOrFail($id);
        $conference->start_date = $conference->start_date->format('Y-m-d');
        $conference->end_date = $conference->end_date->format('Y-m-d');
        return response()->json($conference);
    }

    /**
     * Update the specified resource in storage.
     * $id is encorded in FormData
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $conference = Conference::with('themes')->findOrFail($request->id);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description'=>'required',
            'venue'=>'required|max:255',
            'tag_line'=>'required|max:255',
            'subject_area'=>'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
        ]);
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date']);
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date']);

        try {
            $conference->update($validatedData);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/conference/images');
                $conference->image = basename($path);
                $conference->save();
            }
        
        } catch (\Exception $exception) {
            abort(403, $exception->getMessage());
        }
        return response()->json($conference);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id (id of the \App\Conference) 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();
    }
}
