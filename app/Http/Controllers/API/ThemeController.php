<?php

namespace App\Http\Controllers\API;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Theme;
use App\ThemeLeader;
use App\User;
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
        $themes = Theme::with('themeLeaders')->ofConference($conferenceId)->get();
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
            'themeLeaders.*.user.email' => 'sometimes|required|email',
            'themeLeaders.*.user.title' => 'sometimes|required',
            'themeLeaders.*.user.firstName' => 'sometimes|required',
            'themeLeaders.*.user.surname' => 'sometimes|required'
        ]);
        $conference = Conference::findOrFail($id);
        try {
            $theme = new Theme;
            $theme->title = $validatedData['title'];
            $theme->description = $validatedData['description'];
            $theme->conference()->associate($conference);
            $theme->save();

            foreach ($request->themeLeaders as $key => $themeLeaderArray) {
                $themeLeaderData = json_decode(json_encode($themeLeaderArray), FALSE);
                $themeLeader = new ThemeLeader;

                if (!isset($themeLeaderData->user->id)) {

                    $user = new User;
                    $user->email = $themeLeaderData->user->email;
                    $user->name = $themeLeaderData->user->title.' '.$themeLeaderData->user->firstName.' '.$themeLeaderData->user->surname;
                    $user->password = md5(rand().time());
                    $user->save();
                } else {
                    $user = User::findOrFail($themeLeaderData->user->id);
                }
                $themeLeader->user()->associate($user);
                $themeLeader->theme()->associate($theme);
                $themeLeader->save();
            }

        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response()->json($theme->id);
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
        try {
            $theme->conference()->dissociate();
            $theme->delete();
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
        return response()->json([
            'title' => 'Completed',
            'message' => 'Theme deleted sucessfully',
            'type' => 'success'
        ], 200);
    }
}
