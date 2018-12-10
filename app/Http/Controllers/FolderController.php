<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Resources\FolderResource;

class FolderController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->only(['create','store','edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FolderResource::collection(Folder::orderBy('created_at','desc')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'nullable',
            'public_image' => 'nullable',
        ]);

        $image = new Folder;
        $image->title=$request->title;
        $image->description=$request->description;
        if($request->public_image==null){
            $image->public_image='images/placeholder-image.jpg';
        }else{
            $image->public_image=$request->public_image;
        }
        if($request->password=='true')
            $image->password=str_random(12);
        else
            $image->password=null;

        $image->save();

        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        return $folder->with('images')->find($folder);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
    }
}
