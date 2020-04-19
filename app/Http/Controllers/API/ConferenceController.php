<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Conference;
use App\Paper;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    /*
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index', 'show', 'displayImage', 'edit', 'store'
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
            'start_date' => 'required|date_format:Y-m-d|after:yesterday',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'image' => 'required|image|max:5000|mimes:jpg,jpeg,bmp,png,svg'
        ]);
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date']);
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date']);
        try {
            $path = $request->file('image')->store('uploads');
            $conference = Conference::create($validatedData);
            $conference->image = $path;
            $conference->save();
        } catch (\Exception $exception) {
            abort(403, $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->start_date = $conference->start_date->format('Y-m-d');
        $conference->end_date = $conference->end_date->format('Y-m-d');
        return response()->json($conference);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conference $conference)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description'=>'required',
            'venue'=>'required|max:255',
            'tag_line'=>'required|max:255',
            'subject_area'=>'required|max:255',
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y|after:start_date',
            'image' => 'required'
        ]);
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date']);
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date']);

        try {
            $conference->update($validatedData);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('uploads');
                $conference->image = $path;
                $conference->save();
            }
            request()->session()->flash('message', 'Conference updated successfully.');
            request()->session()->flash('message-type', 'success');
        } catch (\Exception $exception) {
            abort(403, $exception->getMessage());
        }
        return redirect(route('themes', ['conference'=>$conference]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */

    public function destroy(Conference $conference)
    {
        //
    }

    public function displayImage ($image) {
        $path = 'uploads/'.$image;
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }
        $content = Storage::get($path);
        return response($content)->header('Content-Type', 'png');
    }
}
