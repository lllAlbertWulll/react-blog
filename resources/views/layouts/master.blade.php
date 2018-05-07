<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>爱上猫的鱼灬 | Gargamel的日常和涂鸦</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/font-awesome.css">
    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" id="puma-css" href="/css/bundle.css" type="text/css" media="screen">

    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.lazyload.js"></script>

    @yield('css')
</head>
<body class="home blog">

<div class="surface-content">

    <header class="site-header u-textAlignCenter"
            style='background-image: url({{ asset("/imgs/banner1.jpg") }})'>

        <div class="header-inner">

            <h1 class="site-title" >

                <a href="/" title="爱上猫的鱼灬">爱上猫的鱼灬</a>

            </h1>

            <p class="site-description">Gargamel 的日常和涂鸦</p>

            <div class="social-links">
                <span class="social-link">
                    <a href="/" target="_blank">
                        <i class="fa fa-github fa-lg"> </i>
                    </a>
                </span>
                <span class="social-link">
                    <a href="/" target="_blank">
                        <i class="fa fa-weibo fa-lg"> </i>
                    </a>
                </span>
                <span class="social-link">
                    <a href="/" target="_blank">
                        <i class="fa fa-rss fa-lg"> </i>
                    </a>
                </span>
                <span class="social-link">
                    <a href="javascript:;" class="opensearch">
                        <i class="fa fa-search fa-lg"> </i>
                    </a>
                </span>
            </div>

            <div class="">
                <form role="search" method="get" class="search-form" action="">
                    <label>
                        <span class="screen-reader-text">搜索：</span>
                        <input type="search" class="search-field" placeholder="搜索…" value="" name="s">
                    </label>
                    <input type="submit" class="search-submit" value="搜索">
                </form>
            </div>

        </div>

    </header>

    <nav class="topNav u-textAlignCenter">

        <div class="layoutSingleColumn">
            <ul id="menu-menu-1" class="topNav-items">
                <li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-979">
                    <a href="{{ url('/') }}">首页</a>
                </li>
                <li id="menu-item-958" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-958">
                    <a href="{{ url('/about') }}">关于</a>
                </li>
                <li id="menu-item-959" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-959">
                    <a target="_blank" href="http://imshu.cc/works/">作品</a>
                </li>
                <li id="menu-item-964" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-964">
                    <a href="http://imshu.cc/links/">友链</a>
                </li>
            </ul>
        </div>

    </nav>
    <main class="main-content">

        @yield('content')

    </main>
    <footer id="footer">
        <span class="copyright"> © 2018 </span>
        <i class="fa fa-heart"></i>
        <span> Gegewv </span>
    </footer>

</div>

<div class="back-to-top" id="back-to-top"><i class="fa fa-chevron-up"></i></div>

@yield('script')
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/base.js"></script>
{{--<script type="text/javascript" src="/js/opensearch.js"></script>--}}
{{--<script type="text/javascript" src="/js/backtotop.js"></script>--}}
{{--<script type="text/javascript" src="/js/bundle.js"></script>--}}

{{--<script type="text/javascript" src="./index_files/wp-embed.min.js.下载"></script>--}}
{{--<script type="text/javascript" src="/js/jquery.lazyloadxt.extra.js"></script>--}}


{{--<script id="wappalyzer" src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>--}}
</body>
</html>
