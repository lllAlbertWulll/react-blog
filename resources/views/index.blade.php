@extends('layouts.master')

@section('content')
    <section class="blockGroup">
        @foreach($articles as $article)
            <article class="block block--inset block--list">
                <h2 class="block-title post-featured" itemprop="headline">
                    <a href="{{ url("/show/$article->id") }}">{{ $article->title }}</a>
                </h2>
                <div class="block-postMetaWrap u-textAlignCenter">
                    <time>{{ $article->published_at }}</time>
                </div>
                <div class="block-snippet block-snippet--subtitle grap" itemprop="about">
                    <p class="with-img"><!-- Featured Image From URL plugin -->
                        <img alt="" style="" src="{{ $article->cover }}" class="lazy-loaded"></p>
                    <p class="sub-title">{{ $article->subtitle }}</p>
                    <p class="more-link">
                        <a href="{{ url("/show/$article->id") }}" rel="nofollow">
                            <span>继续阅读 <i class="fa fa-angle-double-right"></i></span>
                        </a>
                    </p>
                </div>
                <div class="block-footer">
                    By {{ $article->user->name }} . In
                    @foreach($article->tags as $tag)
                        <a href="" rel="category tag"> {{ $tag->tag }}</a>.
                    @endforeach
                    <div class="block-footer-inner">
                        {{ $article->reply_count }} 回复.
                    </div>
                </div>
            </article>
        @endforeach

    </section>
    <div class="u-textAlignCenter postsFooterNav">
        <div class="posts-nav">
        </div>
    </div>
@endsection
