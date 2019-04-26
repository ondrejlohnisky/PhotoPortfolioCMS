<?php

namespace App\Http\Controllers;

use App\social_link;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->only(['store','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return social_link::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\social_link  $social_link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, social_link $social_link)
    {
        try {
            $social_link->link=$request->link;
            $social_link->save();
        } catch (\Throwable $th) {
            echo $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\social_link  $social_link
     * @return \Illuminate\Http\Response
     */
    public function destroy(social_link $social_link)
    {
        //
    }
}
