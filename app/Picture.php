<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $guarded = ['id'];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }
}
