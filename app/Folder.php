<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $hidden = [
        'password', 'password_count',
    ];
    
    public function images(){
        return $this->hasMany(Image::class);
    }
}
