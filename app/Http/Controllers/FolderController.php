<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Password;
use Illuminate\Http\Request;
use App\Http\Resources\FolderResource;
use Illuminate\Support\Facades\Storage;
use File;

class FolderController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->only(['store','update','destroy','adminShow']);
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

        $folder = new Folder;
        $folder->title=$request->title;
        $folder->description=$request->description;
        if($request->hasFile("public_image")){
            if($request->file("public_image")->isValid()){
                $imagePath = $request->public_image->store("images/public_images","public");
                $folder->public_image="/".$imagePath;
            }
        }else{
            $folder->public_image='/images/placeholder-image.jpg';
        }
        
        $folder->save();

        return $folder;
    }

    public function adminShow(Folder $folder)
    {   
        return $folder;
    }

    public function checkFolderAccessability(Folder $folder)
    {   
        if(isset($_GET['password'])){
            if(count($folder->passwords()->where('password',$_GET['password'])->get())>0){
                if($folder->passwords()->where('password',$_GET['password'])->get()[0]->password_count>0){
                    return ['error' => false];
                }else{
                    return ['error' => true, 'message' => 'Heslo se již nedá použít. Požádejte adminitrátora o nové heslo!'];
                }
            }else{
                return ['error' => true,'message' => 'Špatné heslo'];
            }
        }else{
            return ['error' => true,'message' => 'Heslo je požadováno'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {   
        if($folder->passwords()->exists()){
            if(isset($_GET['password'])){
                if(count($folder->passwords()->where('password',$_GET['password'])->get())>0){
                    if($folder->passwords()->where('password',$_GET['password'])->get()[0]->password_count>0){
                        $password_count=$folder->passwords()->where('password',$_GET['password'])->get()[0]->password_count;
                        $folder->passwords()->where('password',$_GET['password'])->decrement('password_count');
                        return $folder;
                    }else{
                        return ['error' => true, 'message' => 'Heslo se již nedá použít. Požádejte adminitrátora o nové heslo!'];
                    }
                }else{
                    return ['error' => true,'message' => 'Špatné heslo!'];
                }
            }else{
                return ['error' => true,'message' => 'Heslo je požadováno'];
            }
        }else{
            return $folder;
        }
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
        Storage::deleteDirectory('images/folders/'.$folder->id);
        Storage::disk('public')->delete($folder->public_image);

        $folder->images()->delete();
        $folder->passwords()->delete();
        $folder->delete();
        return ['error' => false,'message' => 'Složka smazána!'];
    }
}
