<?php

namespace App\Http\Controllers\API;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Theme;
use Exception;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $themes = Theme::ofConference($conferenceId);
        return response()->json($themes);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $id - Conference ID
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:themes|max:255',
            'description' => 'required',
        ]);
        $conference = Conference::findOrFail($id);
        try {
            $theme = new Theme;
            $theme->title = $validatedData['title'];
            $theme->description = $validatedData['description'];
            $theme->conference()->associate($conference);
            $theme->save();
        return response()->json($theme);

        } catch (\Exception $exception) {
            abort(403, $exception->getMessage());
        }
        return response()->json([
            'title' => 'Completed',
            'message' => 'Theme added sucessfully',
            'type' => 'success'
        ], 200);

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
        $theme = Theme::findOrFail($id);
        if(count($theme->papers)>0) {
            return response()->json([
                'title'=>'Error',
                'message'=>'Cannot delete this theme as papers have already been allocated',
                'type'=>'error']
                , 200);
        }
        try{
            $theme->conference()->dissociate();
            $theme->delete();
        }catch (Exception $e) {
            abort(500, $e->getMessage());
        }
        return response()->json([
            'title'=>'Completed',
            'message'=>'Theme deleted sucessfully',
            'type'=>'success'
        ],200);
    }
}
