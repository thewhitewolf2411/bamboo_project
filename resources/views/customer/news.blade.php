@extends('customer.layouts.layout')

@section('content')
<div class="app">
    <div class="news-page news-title-container">
        <div class="center-title-container">
            <p class="large-page-title">News & Blog</p>
        </div>
    </div>

    @if(Session::get('_previous') !== null)
        <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
    @else
        <a class="back-to-home-footer mt-3" href="/">
    @endif
        <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>

    <div class="container">

        @if(count($blogs) === 0)
        @else

            <div class="news-main-row">
                {{-- <div class="col-md-8"> --}}
                <div class="news-primary">
                    <a class="news-main-item" href="/news/{{$blogs->first()->id}}">
                        {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                        <img class="news-image main" src="/storage/news_images/{{$blogs->first()->image_1}}">
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
                                    <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-p">{{$blogs->first()->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-md-4"> --}}
                    <div class="news-secondary">
                        @if($blogs->count() >= 3)
                            <a class="news-secondary-item first" href="/news/{{$blogs->skip(1)->first()->id}}">
                                {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                                <img class="news-image main" src="/storage/news_images/{{$blogs->skip(1)->first()->image_1}}">
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
                                            <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                            <p class="created-at-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a class="news-secondary-item second" href="/news/{{$blogs->skip(2)->first()->id}}">
                                {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                                <img class="news-image main" src="/storage/news_images/{{$blogs->skip(2)->first()->image_1}}">
                                <div class="news-content-container">
                                    <div @if($blogs->skip(2)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(2)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                        <p class="tag-content">@if($blogs->skip(2)->first()->cms_type === 0) NEWS @elseif($blogs->skip(2)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                    </div>
                                    <div class="news-title main mt-2">
                                        <p>{{$blogs->skip(2)->first()->cms_title}}</p>
                                    </div>
                                    <div class="row m-0 mt-2">
                                        <div class="news-author-row mr-2">
                                            <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                            <p class="author-p">{{$blogs->skip(2)->first()->author}}</p>
                                        </div>
                                        <div class="news-created-at-row ml-4">
                                            <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                            <p class="created-at-p">{{$blogs->skip(2)->first()->created_at->format('F d, Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif


                        @if($blogs->count() == 2)
                            <a class="news-main-item first-full-height" href="/news/{{$blogs->skip(1)->first()->id}}">
                                {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                                <img class="news-image main" src="/storage/news_images/{{$blogs->skip(1)->first()->image_1}}">
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
                                            <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                            <p class="created-at-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif

                    </div>
                {{-- </div> --}}
            </div>

        @endif

        @if(count($all_news) > 0)
            <div class="latest-news d-flex flex-column mt-5 ml-2 mr-2">
                <div class="title">Latest News</div>
        
                <div class="news-row mt-2">
                    @foreach($all_news as $news)
                        <a class="all-news-item" href="/news/{{$news->id}}">
                            {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                            <img class="news-image main" src="/storage/news_images/{{$news->image_1}}">
                            <div class="news-content-container bottom-centered">
                                <div class="news-tag">
                                    <p class="tag-content">NEWS</p>
                                </div>
                                <div class="news-title main mt-2">
                                    <p>{{$news->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2 mb-2">
                                        <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-p">{{$news->author}}</p>
                                    </div>
                                    <div class="news-created-at-row">
                                        <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-p">{{$news->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(count($all_blogs) > 0)
            <div class="latest-blogs d-flex flex-column mt-5 ml-2 mr-2">
                <div class="title">Latest Blogs</div>
        
                <div class="blogs-row mt-2">
                    @foreach($all_blogs as $blog)
                        <a class="all-blogs-item" href="/news/{{$blog->id}}">
                            {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                            <img class="news-image main" src="/storage/news_images/{{$blog->image_1}}">
                            <div class="news-content-container bottom-centered">
                                <div class="blog-tag">
                                    <p class="tag-content">BLOG</p>
                                </div>
                                <div class="news-title main mt-2">
                                    <p>{{$blog->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2 mb-2">
                                        <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-p">{{$blog->author}}</p>
                                    </div>
                                    <div class="news-created-at-row">
                                        <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-p">{{$blog->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    @if($all_howto->count() > 1)

        <div class="latest-howto d-flex flex-column mt-5">

            <div class="howto-top-two">
                <p>How to with boo</p>
                <div class="main-howto-row container">

                    <a class="main-howto-item" href="/news/{{$all_howto->first()->id}}">
                        {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                        <img class="news-image main" src="/storage/news_images/{{$all_howto->first()->image_1}}">
                        <div class="news-content-container bottom-centered">
                            <div class="how-to-tag">
                                <p class="tag-content">HOW TO, WITH BOO</p>
                            </div>
                            <div class="news-title main mt-2">
                                <p>{{$all_howto->first()->cms_title}}</p>
                            </div>
                            <div class="row m-0 mt-2">
                                <div class="news-author-row mr-2 mb-2">
                                    <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                    <p class="author-p">{{$all_howto->first()->author}}</p>
                                </div>
                                <div class="news-created-at-row">
                                    <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-p">{{$all_howto->first()->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="main-howto-item" href="/news/{{$all_howto->skip(1)->first()->id}}">
                        {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                        <img class="news-image main" src="/storage/news_images/{{$all_howto->skip(1)->first()->image_1}}">
                        <div class="news-content-container bottom-centered">
                            <div class="how-to-tag">
                                <p class="tag-content">HOW TO, WITH BOO</p>
                            </div>
                            <div class="news-title main mt-2">
                                <p>{{$all_howto->skip(1)->first()->cms_title}}</p>
                            </div>
                            <div class="row m-0 mt-2">
                                <div class="news-author-row mr-2 mb-2">
                                    <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                    <p class="author-p">{{$all_howto->skip(1)->first()->author}}</p>
                                </div>
                                <div class="news-created-at-row">
                                    <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-p">{{$all_howto->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            <div class="howto-transparent">

            </div>

            <div class="title container">Latest How To With Boo Articles</div>

            <div class="howto-row transparent-bg container">
                @foreach($all_howto as $howto)
                    <a class="all-howto-item" href="/news/{{$howto->id}}">
                        {{-- <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs->first()->image_1}}')"> --}}
                        <img class="news-image main" src="/storage/news_images/{{$howto->image_1}}">
                        <div class="news-content-container bottom-centered">
                            <div class="how-to-tag">
                                <p class="tag-content">HOW TO, WITH BOO</p>
                            </div>
                            <div class="news-title main mt-2">
                                <p>{{$howto->cms_title}}</p>
                            </div>
                            <div class="row m-0 mt-2">
                                <div class="news-author-row mr-2 mb-2">
                                    <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                    <p class="author-p">{{$howto->author}}</p>
                                </div>
                                <div class="news-created-at-row">
                                    <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-p">{{$howto->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>


        </div>
    @endif
    

    @include('partial.newscontactsupport')

    @include('customer.layouts.footer', ['showGetstarted' => true])
    
</div>

<script>
    $(document).ready(function() {
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