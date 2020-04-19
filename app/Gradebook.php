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

    //https://laravel.com/docs/7.x/eloquent#local-scopes
    public function scopeSearch($query, $skip, $take, $name = null){
        $query = $query->orderBy('created_at', 'desc');

        if ($name !== null) {
            $query = $query->where('name', 'LIKE', '%' . $name . '%');
        }

        return $query
            ->skip($skip)
            ->take($take)
            ->with('professor');
    }


}
