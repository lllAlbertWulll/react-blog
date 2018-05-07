<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'keyword', 'articles_count'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
