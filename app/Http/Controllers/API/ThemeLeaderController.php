<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Theme;
use App\ThemeLeader;
use Illuminate\Http\Request;
use App\Http\Resources\ThemeLeader as ThemeLeaderResource;
use App\Http\Resources\User as UserResource;
use App\User;

class ThemeLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Theme
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Theme $theme)
    {
        $themeLeaders = ThemeLeader::ofTheme($theme->id);
        return $themeLeaders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;
        $themeLeader = ThemeLeader::ofUserEmail($email)->first();
        if ($themeLeader) {
            return response()->json($themeLeader);
        }else{
            return response()->json(['message'=>'No users found']);
        }
    }

    public function user(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email',$validatedData['email'])->firstOrFail();
        $user->makeVisible(['email']);
        $user->makeVisible(['id']);
        return response()->json($user);
    }
}
