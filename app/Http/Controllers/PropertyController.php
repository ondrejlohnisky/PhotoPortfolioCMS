<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    
    public function setGlobalFoldersPassword(Request $request){
        $password = Property::where('name','globalFoldersPassword')->first();
        $password->update(['value' => $request->password]);
        return $password;
    }

    public function getGlobalFoldersPassword(){
        $password = Property::where('name','globalFoldersPassword')->first();
        return $password;
    }
}
