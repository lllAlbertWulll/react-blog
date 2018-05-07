<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag', 'articles_count'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
