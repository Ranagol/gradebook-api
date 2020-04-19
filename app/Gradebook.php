<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function search($name, $skip, $take){
        return self::where('name', 'LIKE', '%' . $name . '%')->skip($skip)->take($take)->get();
    }


}
