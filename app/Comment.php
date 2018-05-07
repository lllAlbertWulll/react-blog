<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'article_id', 'parent_id', 'target_name', 'name', 'email',
        'website', 'avatar', 'comment', 'ip', 'city', 'is_delete', 'is_read'
    ];

    /**
     * 获得此评论所属的文章。
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获得此评论所有的回复
     */
    public function replys()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
