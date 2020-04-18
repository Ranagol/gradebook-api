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
    /*
    public static function search($title, $skip, $take){
        //url command for give me all movies that have 'night' in their title: /movies?title=night
        //url command for skip the first five movie, take the next 10 movies: /movies?take=10&skip=5
        //combined url command: /movies?take=10&skip=5&title=night
        //return self Movie model
        //find movies with this title
        //skip what has to be skipped
        //take what has to be taken
        return self::where('title', 'LIKE', '%'.$title.'%')->skip($skip)->take($take)->get();
    }
    */

    public static function search($name, $skip, $take){
        return self::where('name', 'LIKE', '%' . $name . '%')->skip($skip)->take($take)->get();
    }


}
