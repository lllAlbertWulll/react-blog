<?php
namespace App\Repositories;

use App\Article;
use App\Comment;
use Parsedown;

class HomeRepository
{
    protected $parsedown;

    public function __construct(Parsedown $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    // Article

    public function findArticleAll()
    {
        return Article::where('is_delete', 0)->orderBy('published_at', 'desc')->get();
    }

    public function findSingleById($id) {
        return Article::find($id);
    }

    public function incrementArticleView($id) {
        return Article::find($id)->increment('view_count');
    }

    public function getPrevArticle($id)
    {
        $prev_id = Article::where('id', '<', $id)->max('id');
        return Article::find($prev_id);
    }

    public function getNextArticle($id)
    {
        $next_id = Article::where('id', '>', $id)->min('id');
        return Article::find($next_id);
    }

    // Comment

    public function getCommentCount()
    {
        return Comment::count();
    }

    public function markdownToHtml($data)
    {
        return $this->parsedown->setBreaksEnabled(true)->text($data);
    }
}