<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function passwords(){
        return $this->hasMany(Password::class);
    }
    
    public function images(){
        return $this->hasMany(Image::class);
    }
}
