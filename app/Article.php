<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'title', 'subtitle', 'cover', 'content', 'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        // 第一个参数：相关联的模型类
        // 第二个参数（可选）：枢纽表/也就是关联表，如果不想使用默认的枢纽表命名方式，可以传递数据库表名
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
