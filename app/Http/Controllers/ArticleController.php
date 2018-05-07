<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateArticlePost;
use App\Keyword;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticlePost;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
//        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->findArticleIndex();
        return view('admin.article.index', compact('articles'));
    }

    public function index_api()
    {
        $articles = $this->articleRepository->findArticleApi();
        return response()->json($articles);
    }

    public function add()
    {
        return view('admin.article.add');
    }

    public function store(StoreArticlePost $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'title' => $request->post('title'),
            'subtitle' => $request->post('subtitle'),
            'cover' => $request->file('cover')->store('/uploads/'.date('Y-m-d', time())),
            'content' => $request->post('content'),
            'published_at' => date('Y-m-d H:i:s', strtotime($request->post('published_at')))
        ];
        $keywords = $this->articleRepository->normalizeKeyword($request->post('keywords'));
        $tags = $this->articleRepository->normalizeTag($request->post('tags'));
        $article = $this->articleRepository->createArticle($data);

        $article->keywords()->attach($keywords);
        $article->tags()->attach($tags);

        return redirect('/admin/article/index');
    }

    public function edit($id)
    {
        $article = $this->articleRepository->findSingleById($id);
        return view('admin.article.edit', compact('article'));
    }

    public function show_api($id)
    {
        $article = $this->articleRepository->findSingleById($id);
        for ($i=0; $i < sizeof($article->tags); $i++) {
            $article->tags[$i] = $article->tags[$i]->tag;
        }
        for ($i=0; $i < sizeof($article->keywords); $i++) {
            $article->keywords[$i] = $article->keywords[$i]->keyword;
        }

        $tags= Tag::all();
        $keywords = Keyword::all();
        for ($i=0; $i < sizeof($tags); $i++) {
            $tags[$i] = $tags[$i]->tag;
        }
        for ($i=0; $i < sizeof($keywords); $i++) {
            $keywords[$i] = $keywords[$i]->keywords;
        }
        return response()->json([
            'article' => $article,
            'tags_arr' => $tags,
            'keywords_arr' => $keywords
        ]);
    }

    public function update(UpdateArticlePost $request, $id)
    {
        $article = $this->articleRepository->findSingleById($id);
        $data = [
            'title' => $request->post('title'),
            'subtitle' => $request->post('subtitle'),
            'content' => $request->post('content'),
            'published_at' => date('Y-m-d H:i:s', strtotime($request->post('published_at')))
        ];

        if ($request->file('cover') != null) {
            $data['cover'] = $request->file('cover')->store('/uploads/'.date('Y-m-d', time()));
        }

        $keywords = $this->articleRepository->normalizeKeyword($request->post('keywords'));
        $tags = $this->articleRepository->normalizeTag($request->post('tags'));
        $article->update($data);

        $article->keywords()->sync($keywords);
        $article->tags()->sync($tags);

        return redirect('/admin/article/index');
    }

    public function update_api(Request $request)
    {
        Log::info($request);
    }

    public function delete($id)
    {
        $this->articleRepository->deleteById($id);
        return redirect('/admin/article/index');
    }

    public function trash()
    {
        $articles = $this->articleRepository->findArticleTrash();
        return view('admin.article.trash', compact('articles'));
    }

    public function recovery($id)
    {
        $this->articleRepository->recoveryById($id);
        return redirect('/admin/article/trash');
    }

    public function destroy($id)
    {
        $this->articleRepository->destroyById($id);
        return redirect('/admin/article/trash');
    }
}
