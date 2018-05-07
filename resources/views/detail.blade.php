@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="/css/markdown.css">
    <link rel="stylesheet" href="/css/default.css">
    <script type="text/javascript" src="/js/highlight.pack.js"></script>
@endsection

@section('content')
    <section class="section-body">

        <header class="section-header u-textAlignCenter">

            <h2 class="grap--h2">{{ $article->title }}</h2>

            <div class="block-postMetaWrap">

                <span class="published_time">{{ $article->published_at }}</span>

            </div>

        </header>

        <div class="markdown">
            {!! $article->content !!}
            <hr>
        </div>

        <div class="post--keywords" itemprop="keywords">
            @foreach($article->tags as $tag)
                <a href="" class="post--keyword">
                    {{ $tag->tag }}
                </a>
            @endforeach
        </div>

        @if($prev_article || $next_article)
            <nav class="navigation post-navigation" role="navigation">
                <h2 class="screen-reader-text">文章导航</h2>
                <div class="nav-links">
                    @if($prev_article)
                        <div class="nav-previous" style="background-image: url({{ asset($prev_article->cover) }})">
                            <a href="{{ url("/show/$prev_article->id") }}" rel="prev">
                                <span class="meta-nav">上卷</span>
                                <span class="post-title">{{ $prev_article->title }}</span>
                            </a>
                        </div>
                    @endif
                    @if($next_article)
                        <div class="nav-next" style="background-image: url({{ asset($next_article->cover) }})">
                            <a href="{{ url("/show/$next_article->id") }}" rel="next">
                                <span class="meta-nav">下卷</span>
                                <span class="post-title">{{ $next_article->title }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </nav>
        @endif
        <div class="postFooterinfo u-textAlignCenter">

            <img alt="" src="/imgs/default.png"
                 class="avatar avatar-64 photo lazyLoad" height="64" width="64">
            <h3 class="author-name">Gegewv</h3>

            <div class="author-description"></div>

            <div class="author-meta">
                <span class="author-meta-item">
                    <i class="fa fa-link"></i>
                    <a href="/">http://gegewv.com/</a>
                </span>
            </div>

        </div>

        <div id="comments" class="responsesWrapper">
            <meta content="UserComments:2" itemprop="interactionCount">
            <h3 class="comments-title">共有 <span class="commentCount">{{ $comments_count }}</span> 条评论</h3>
            @foreach($comments as $comment)
                <ol class="commentlist">
                    <li id="comment-16" class="comment even thread-even depth-1 parent">
                        <article id="div-comment-16" class="comment-body">
                            <footer class="comment-meta">
                                <div class="comment-author vcard">
                                    <img src="{{ $comment->user_id == 1 ? $comment->user->avatar : $comment->avatar }}" class="avatar avatar-48 photo" height="48"
                                         width="48">
                                    <b class="fn">
                                        @if($comment->user_id == 1)
                                            <a href="/" class="url"> 爱上猫的鱼灬</a>
                                            <span class="author"> 作 者</span>
                                        @else
                                            <a href="{{ $comment->website }}" class="url">{{ $comment->name }}</a>
                                        @endif
                                    </b>

                                </div><!-- .comment-author -->
                                <div class="comment-metadata">
                                    <span>{{ $comment->created_at_diff }} · {{ $comment->city }}</span>
                                </div><!-- .comment-metadata -->
                            </footer><!-- .comment-meta -->

                            <div class="comment-content">
                                <p>{{ $comment->comment }}</p>
                            </div><!-- .comment-content -->

                            <div class="reply">
                                <a class="comment-reply-link" href="" data-toggle="modal" data-target="#commentModal"
                                   data-replyid="{{ $comment->id }}" data-replyname="{{ $comment->name }}">
                                    <i class="fa fa-reply"></i> 回复
                                </a>
                            </div>
                        </article><!-- .comment-body -->
                        @foreach( $comment->replys as $reply )
                            <ol class="children">
                                <li id="comment-17"
                                    class="comment byuser comment-author-shustrovsky bypostauthor odd alt depth-2">
                                    <article id="div-comment-17" class="comment-body">
                                        <footer class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img alt="" src="{{ $reply->avatar }}"
                                                     class="avatar avatar-48 photo" height="48" width="48">
                                                <b class="fn">
                                                    @if($reply->user_id == 1)
                                                        <a href="/" class="url"> 爱上猫的鱼灬</a>
                                                        <span class="author"> 作 者</span>
                                                    @else
                                                    <a href="{{ $reply->website }}" class="url">{{ $reply->name }}</a>
                                                    @endif
                                                </b>
                                            </div><!-- .comment-author -->
                                            <div class="comment-metadata">
                                                    <span>{{ $reply->created_at_diff }} · {{ $reply->city }}</span>
                                            </div><!-- .comment-metadata -->
                                        </footer><!-- .comment-meta -->
                                        <div class="comment-content">
                                            <p>回复 <b>{{ $reply->target_name }}</b>：{{ $reply->comment }}</p>
                                        </div><!-- .comment-content -->
                                        <div class="reply">
                                            <a class="comment-reply-link" href="" data-toggle="modal"
                                               data-target="#commentModal" data-replyid="{{ $comment->id }}"
                                               data-replyname="{{ $reply->name }}">
                                                <i class="fa fa-reply"></i> 回复
                                            </a>
                                        </div>
                                    </article><!-- .comment-body -->
                                </li><!-- #comment-## -->
                            </ol><!-- .children -->
                        @endforeach
                    </li><!-- #comment-## -->
                </ol>
            @endforeach
            <nav class="navigation comment-navigation u-textAlignCenter">
                <button class="comment-btn" data-toggle="modal" data-target="#commentModal">参与评论</button>
            </nav>

            <!-- comment Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">说点什么吧..</h4>
                        </div>
                        <div class="modal-body">
                            <form id="commentForm" action="{{ route('addComment') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">昵称</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="施主，怎么称呼？"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">电邮</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="放心，老衲不会向外泄露您的电邮" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">评论</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"
                                              required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">个人网站</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                           placeholder="[选填] 包含 http:// 或 https:// 的完整域名">
                                </div>
                                <input type="hidden" id="parent_id" name="parent_id">
                                <input type="hidden" id="target_name" name="target_name">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault();document.getElementById('commentForm').submit();">OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            hljs.initHighlightingOnLoad();
        });
        $('#commentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (button.data('replyid')) {
                var replyid = button.data('replyid');
                var replyname = button.data('replyname') ? button.data('replyname') : '匿名';

                var modal = $(this);
                modal.find('#parent_id').val(replyid);
                modal.find('#target_name').val(replyname);
                modal.find('#comment').attr("placeholder", "回复 @" + replyname)
            } else {
                var modal = $(this);
                modal.find('#parent_id').val(0);
                modal.find('#target_name').val('');
                modal.find('#comment').attr("placeholder", "")
            }
        });
    </script>
    <script type="text/javascript" src="/js/script.js"></script>
@endsection