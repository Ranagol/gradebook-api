<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    protected $guarded = ['id'];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
