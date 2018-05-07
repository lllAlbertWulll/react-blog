<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\CommentRepository;
use App\Repositories\HomeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeRepository;
    protected $commentRepository;

    public function __construct(HomeRepository $homeRepository, CommentRepository $commentRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $articles = $this->homeRepository->findArticleAll();
        return view('index', compact('articles'));
    }

    public function show($id)
    {
        $article = $this->homeRepository->findSingleById($id);
        $article->increment('view_count');

        $article->content = $this->homeRepository->markdownToHtml($article->content);
        $prev_article = $this->homeRepository->getPrevArticle($id);
        $next_article = $this->homeRepository->getNextArticle($id);

        // 顶级评论
        $comments = $article->comments()->where(['parent_id' => 0, 'is_delete' => 0])->orderBy('created_at', 'desc')->get();

        // 评论回复
        for ($i=0; $i < sizeof($comments); $i++) {
            $comments[$i]->created_at_diff = $comments[$i]->created_at->diffForHumans();
            $replys = $comments[$i]->replys;
            for ($j=0; $j < sizeof($replys); $j++) {
                $replys[$j]->created_at_diff = $replys[$j]->created_at->diffForHumans();
            }
        }
        $comments_count = $this->homeRepository->getCommentCount();

        return view('detail', compact('article', 'prev_article', 'next_article', 'comments', 'comments_count'));
    }

    public function about()
    {
        return view('about');
    }

    public function jianli()
    {
        return view('jianli');
    }


}
