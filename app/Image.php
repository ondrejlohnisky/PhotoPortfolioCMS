<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function folder(){
        return $this->belongsTo(Folder::class);
    }
}
