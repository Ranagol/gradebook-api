<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function gradebook(){
        return $this->belongsTo(Gradebook::class);
    }
}
