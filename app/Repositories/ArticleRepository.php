<?php
namespace App\Repositories;

use App\Article;
use App\Keyword;
use App\Tag;

class ArticleRepository
{
    public function createArticle(array $attributes) {
        return Article::create($attributes);
    }

    public function deleteById($id) {
        return Article::where('id', $id)->update(['is_delete' => 1]);
    }

    public function recoveryById($id) {
        return Article::where('id', $id)->update(['is_delete' => 0]);
    }

    public function destroyById($id) {
        return Article::destroy($id);
    }

    public function findSingleById($id) {
        return Article::findOrFail($id);
    }

    public function findArticleIndex()
    {
        return Article::select('id', 'title', 'published_at')
            ->where('is_delete', 0)
            ->get();
    }

    public function findArticleApi()
    {
        return Article::all();
    }

    public function findArticleTrash()
    {
        return Article::select('id', 'title', 'published_at')
            ->where('is_delete', 1)
            ->get();
    }

    public function normalizeKeyword($keywords)
    {
        return collect($keywords)->map(function ($keyword) {
            if (is_numeric($keyword)) {
                Keyword::find($keyword)->increment('articles_count');
                return (int)$keyword;
            }
            $newKeyword = Keyword::create(['keyword' => $keyword, 'articles_count' => 1]);
            return $newKeyword->id;
        })->toArray();
    }

    public function normalizeTag($tags)
    {
        return collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                Tag::find($tag)->increment('articles_count');
                return (int)$tag;
            }
            $newTag = Tag::create(['tag' => $tag, 'articles_count' => 1]);
            return $newTag->id;
        })->toArray();
    }
}