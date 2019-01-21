<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $fillable=['password_count'];

    public function folder(){
        return $this->belongsTo(Folder::class);
    }
}
