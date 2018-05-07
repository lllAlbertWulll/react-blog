@extends('layouts.master')

@section('content')
        <section class="section-body">
            <header class="section-header u-textAlignCenter">
                <h2 class="grap--h2">关于</h2>
            </header>
            <div class="grap">
                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        <img class="alignnone wp-image-1095 size-thumbnail" src="./imgs/logo-150x150.png"
                                alt="" width="150" height="150"
                                srcset="http://imshu.cc/wp-content/uploads/2017/05/logo-150x150.png 150w, http://imshu.cc/wp-content/uploads/2017/05/logo-300x300.png 300w, http://imshu.cc/wp-content/uploads/2017/05/logo-768x768.png 768w, http://imshu.cc/wp-content/uploads/2017/05/logo.png 800w"
                                sizes="(max-width: 150px) 100vw, 150px">
                    </span>
                </p>

                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        我是Shustrovsky.exe 一个广告平面设计；拖延症，懒癌，手残；Steam蒸汽朋巴克。喜欢没事瞎折腾。
                    </span>
                </p>

                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        这个博客建立于2016年12月25日，当时扔在一个免费的Wordpress托管服务器上。后来由于不放心，迁移到现在的服务器。
                    </span>
                </p>

                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        博客的建立的目的起初是为了存放作品和简历，充当简历的拓展。现在已经成了个人日记和其他服务跳板。
                    </span>
                </p>

                <hr>
                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        2018年1月17日 删掉了之前所有的博客，博客由
                        <img title="" src="./imgs/wcmmm.png" alt="" width="92" height="24">
                        改名 “原子咖啡厅” （一部电影同名，同时也是辐射粉）。
                    </span>
                </p>

                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        只是想新的开始。
                    </span>
                </p>

                <hr>
                <p style="text-align: center;">
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        简历:
                        <a href="{{ url('/jianli') }}" rel="noopener noreferrer">http://gegewv.com/jianli/</a>
                    </span>
                    <br>
                    <span style="font-size: 14px; font-family: arial, helvetica, sans-serif;">
                        邮箱：gegewv@outlook.com
                    </span>
                </p>
                <p style="text-align: center;"></p>
            </div>
        </section>
        <div class="u-textAlignCenter postsFooterNav">
            <div class="posts-nav">
            </div>
        </div>
@endsection
