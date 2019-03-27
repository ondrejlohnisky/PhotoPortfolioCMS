<?php

namespace App\Http\Controllers;

use App\Image;
use App\Folder;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->only(['store','update','destroy','adminGetImages']);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array();
        foreach (Folder::all() as $folder) {
            $isLocked=Folder::find($folder->id)->passwords()->exists();
            if(!$isLocked){
                array_push($response,Folder::find($folder->id)->images()->first());
            }
        }
        return $response;
    }

    public function adminGetImages(Folder $folder){
        return $folder->images()->simplePaginate(10);
    }


    public function getImages(Folder $folder){
        if($folder->passwords()->exists()){
            if(isset($_GET['password'])){
                if(count($folder->passwords()->where('password',$_GET['password'])->get())>0){
                    if($folder->passwords()->where('password',$_GET['password'])->get()[0]->password_count>0){
                        $folder->passwords()->where('password',$_GET['password'])->decrement('password_count');
                        return $folder->images()->simplePaginate(10);
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
            return $folder->images()->simplePaginate(10);
        }
    }

    // public function adminAccessRawImage($folderID,$image){
    //     return response()->file(Storage_path('app/images/folders/'.$folderID.'/').$image);
    // }

    public function accessRawImage($folderID,$image){
        $folder=Folder::find($folderID);
        if(count($folder->passwords()->get())>0){
            if($user = Auth::user()){ //pokud je admin
                return response()->file(storage_path('app/images/folders/'.$folderID.'/').$image); //vrátí foto
            }else{
                if(isset($_GET['password'])){ 
                    if(count($folder->passwords()->where('password',$_GET['password'])->get())>0){ //pokud je heslo shodující se s heslem zadaným
                        if($folder->passwords()->where('password',$_GET['password'])->get()[0]->password_count>0){ // pokud není vyčřerpán počet možných použití
                            return response()->file(storage_path('app/images/folders/'.$folderID.'/').$image);
                        }else{
                            return ['error' => true, 'message' => 'Heslo se již nedá použít. Požádejte adminitrátora o nové heslo!'];
                        }
                    }else{
                        return ['error' => true,'message' => 'Špatné heslo'];
                    }
                }else{
                    return ['error' => true,'message' => 'Je požadováno heslo'];
                }
            }
        }else{
            return response()->file(storage_path('app/images/folders/'.$folderID.'/').$image);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->images as $image1) {
            if($image1->isValid()){
                $image = new Image;
                $image->title=basename($image1->getClientOriginalName(), '.'.$image1->getClientOriginalExtension());
                $image->folder_id=$request->folder_id;
                $imagePath = $image1->store("images/folders/".$request->folder_id,"local");
                $image->src="/".$imagePath;
                $image->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $image->title = $request->title;
        $image->description = $request->description;
        $image->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Storage::disk('local')->delete($image->src);
        $image->delete();
        return ['error' => false,'message' => 'Fotka smazána!'];
    }
}
