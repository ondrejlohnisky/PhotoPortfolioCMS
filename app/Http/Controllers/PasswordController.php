<?php

namespace App\Http\Controllers;

use App\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        return Password::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = new Password;
        $password->password_count=$request->password_count;
        $password->folder_id=$request->folder_id;
        // $password->password=$request->password;
        $password->password=str_random(12);
        $password->save();
        return $password;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Password::where('folder_id',$id)->get();
    }

    public function update(Request $request, Password $password)
    {
        $password->update(['password_count' => $request->password_count]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function destroy(Password $password)
    {
        $password->delete();
        
    }
}
