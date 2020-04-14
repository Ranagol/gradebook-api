<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gradebook(){
        return $this->hasOne(Gradebook::class);
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function first_picture () {
        return $this->hasOne(Picture::class);
    }
}
