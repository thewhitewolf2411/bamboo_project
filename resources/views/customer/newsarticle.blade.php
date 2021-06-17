@extends('customer.layouts.layout')

@section('content')
<div class="app">
    <div class="page-header-container news">
        <p class="page-header-text">News & Blog</p>
    </div>

    <a class="back-to-home-footer mt-3 padded" href="/news">
        <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>

    <div class="container view-blog mt-5">
        @switch($blog->cms_type)
            @case(0)
                <div class="view-blog-tag news"><p>NEWS</p></div>
                @break
            @case(1)
                <div class="view-blog-tag blog"><p>BLOG</p></div>
                @break
            @case(2)
                <div class="view-blog-tag howto"><p>HOW TO WITH BOO</p></div>
                @break
        @endswitch
        <p class="view-blog-title">{!!$blog->cms_title!!}</p>

        <div class="info-row-view-blog">
            <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/account_icon_black.svg')}}">
            <p class="view-blog-author ml-1 mr-4">{{$blog->author}}</p>
            <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/time_icon_black.svg')}}">
            <p class="view-blog-date ml-1">{{$blog->created_at->format('F d, Y')}}</p>
            <div class="sharelinks">
                <a href="#"><img src="{{asset('/images/front-end-icons/twitter_share.svg')}}"></a>
                <a href="#"><img src="{{asset('/images/front-end-icons/instagram_share.svg')}}"></a>
                <a href="#"><img src="{{asset('/images/front-end-icons/facebook_share.svg')}}"></a>
                <a href="#"><img src="{{asset('/images/front-end-icons/news_share.svg')}}"></a>
            </div>
        </div>

        {{-- <img class="article-image" src="/storage/news_images/{{$blog->image_1}}"> --}}
        <img class="article-image" src="{{$blog->getFirstImage()}}">

        <p class="view-blog-paragraph bold">{!!$blog->cms_parg_1!!}</p>
        <br>

        <p class="view-blog-paragraph">{!!$blog->cms_parg_2!!}</p>
        <br>

        <p class="view-blog-paragraph">{!!$blog->cms_parg_3!!}</p>
        <br>

    </div>

    <div class="blog-horizontal-line"></div>

    @if($blogs->count() > 1)

        <div class="blog-read-more ml-auto mr-auto mt-5">
            <p class="readmore-view-blog mb-4 ml-2">READ MORE</p>

            <div class="news-main-row">

                <div class="news-primary">
                    <a class="news-main-item" href="/news/{{$blogs->first()->id}}">
                        <img class="news-image main" src="{{$blogs->first()->getFirstImage()}}">
                        <div class="news-content-container">
                            <div @if($blogs->first()->cms_type === 0) class="news-tag" @elseif($blogs->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                <p class="tag-content">@if($blogs->first()->cms_type === 0) NEWS @elseif($blogs->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                            </div>
                            <div class="news-title main mt-2">
                                <p>{{$blogs->first()->cms_title}}</p>
                            </div>
                            <div class="row m-0 mt-2">
                                <div class="news-author-row mr-2">
                                    <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                    <p class="author-p">{{$blogs->first()->author}}</p>
                                </div>
                                <div class="news-created-at-row ml-4">
                                    <img class="news-created-icon ml-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-p">{{$blogs->first()->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="news-secondary">
                    @if($blogs->count() >= 3)
                        <a class="news-secondary-item first" href="/news/{{$blogs->skip(1)->first()->id}}">
                            <img class="news-image main" src="{{$blogs->skip(1)->first()->getFirstImage()}}">
                            <div class="news-content-container smaller-pad">
                                <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="news-smaller-title main mt-2">
                                    <p>{{$blogs->skip(1)->first()->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2">
                                        <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-smaller-p">{{$blogs->skip(1)->first()->author}}</p>
                                    </div>
                                    <div class="news-created-at-row">
                                        <img class="news-created-smaller-icon ml-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-smaller-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a class="news-secondary-item second" href="/news/{{$blogs->skip(2)->first()->id}}">
                            <img class="news-image main" src="{{$blogs->skip(2)->first()->getFirstImage()}}">
                            <div class="news-content-container smaller-pad">
                                <div @if($blogs->skip(2)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(2)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs->skip(2)->first()->cms_type === 0) NEWS @elseif($blogs->skip(2)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="news-smaller-title main mt-2">
                                    <p>{{$blogs->skip(2)->first()->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2">
                                        <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-smaller-p">{{$blogs->skip(2)->first()->author}}</p>
                                    </div>
                                    <div class="news-created-at-row">
                                        <img class="news-created-smaller-icon ml-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-smaller-p">{{$blogs->skip(2)->first()->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif


                    @if($blogs->count() == 2)
                        <a class="news-main-item first-full-height" href="/news/{{$blogs->skip(1)->first()->id}}">
                            <img class="news-image main" src="{{$blogs->skip(1)->first()->getFirstImage()}}">
                            <div class="news-content-container">
                                <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="news-title main mt-2">
                                    <p>{{$blogs->skip(1)->first()->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2">
                                        <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-p">{{$blogs->skip(1)->first()->author}}</p>
                                    </div>
                                    <div class="news-created-at-row ml-4">
                                        <img class="news-created-icon ml-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif

                </div>
            </div>
        </div>

    @endif

    @if(count($howto) > 1)
    <div class="view-blog-howto ml-auto mr-auto mt-5">
        <p class="readmore-view-blog mb-4 ml-2">HOW TO WITH BOO</p>

        <div class="main-howto-row">

            <a class="main-howto-item" href="/news/{{$howto->first()->id}}">
                <img class="news-image main" src="{{$howto->first()->getFirstImage()}}">
                <div class="news-content-container bottom-centered smaller-pad">
                    <div class="how-to-tag">
                        <p class="tag-content">HOW TO, WITH BOO</p>
                    </div>
                    <div class="news-smaller-title main mt-2">
                        <p>{{$howto->first()->cms_title}}</p>
                    </div>
                    <div class="row m-0 mt-2">
                        <div class="news-author-row mr-2 mb-2">
                            <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                            <p class="author-smaller-p">{{$howto->first()->author}}</p>
                        </div>
                        <div class="news-created-at-row ml-4">
                            <img class="news-created-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                            <p class="created-at-smaller-p">{{$howto->first()->created_at->format('F d, Y')}}</p>
                        </div>
                    </div>
                </div>
            </a>

            <a class="main-howto-item" href="/news/{{$howto->skip(1)->first()->id}}">
                <img class="news-image main" src="{{$howto->skip(1)->first()->getFirstImage()}}">
                <div class="news-content-container bottom-centered smaller-pad">
                    <div class="how-to-tag">
                        <p class="tag-content">HOW TO, WITH BOO</p>
                    </div>
                    <div class="news-smaller-title main mt-2">
                        <p>{{$howto->skip(1)->first()->cms_title}}</p>
                    </div>
                    <div class="row m-0 mt-2">
                        <div class="news-author-row mr-2 mb-2">
                            <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                            <p class="author-smaller-p">{{$howto->skip(1)->first()->author}}</p>
                        </div>
                        <div class="news-created-at-row ml-4">
                            <img class="news-created-smaller-icon ml-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                            <p class="created-at-smaller-p">{{$howto->skip(1)->first()->created_at->format('F d, Y')}}</p>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
    <div class="blog-horizontal-line latest"></div>
    @endif

    @include('partial.newscontactsupport')

    @include('customer.layouts.footer', ['showGetstarted' => true])
    
</div>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $(".news-main-item")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this)
        });

        $(".news-secondary-item.first")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this)
        });

        $(".news-secondary-item.second")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this);
        });

        $(".all-news-item")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this);
        });

        $(".all-blogs-item")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this);
        });

        $(".all-howto-item")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this);
        });

        $(".main-howto-item")
        .mouseenter(function() {
            zoomIn(this);
        })
        .mouseleave(function() {
            zoomOut(this);
        });
    });
    
    function zoomIn(aelement){
        let img = aelement.childNodes[1];
        if(!img.classList.contains('zoomed')){
            img.classList.add('zoomed');
        }
    }
    function zoomOut(aelement){
        let img = aelement.childNodes[1];
        if(img.classList.contains('zoomed')){
            img.classList.remove('zoomed');
        }
    }
</script>

@endsection