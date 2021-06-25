@extends('customer.layouts.layout')

<head>
    <meta charset="utf-8">
    <title>{!!$blog->cms_title!!}</title>
    <meta name="description" content="{!!$blog->cms_parg_1!!}">
    <meta name="keywords" content="Mobile, Tablet, Sell, Recycle">
    <meta name="author" content="Bamboorecycle">
    <meta property="og:title" content="{!!$blog->cms_title!!}">
    <meta property="og:description" content="{!!$blog->cms_parg_1!!}" />
    <meta property="og:image" content="{{$blog->getFirstImage()}}">
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="bamboomobile.com">
    <meta name="twitter:domain" content="">
    <meta name="twitter:title" content="{!!$blog->cms_title!!}">
    <meta name="twitter:description" content="{!!$blog->cms_parg_1!!}">
    <meta name="twitter:image" content="{{$blog->getFirstImage()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
            <div class="d-flex flex-row">
                <img class="news-user-icon mr-2" src="{{asset('/images/front-end-icons/account_icon_black.svg')}}">
                <p class="view-blog-author ml-1 mr-4">{{$blog->author}}</p>
                <img class="news-created-icon mr-2" src="{{asset('/images/front-end-icons/time_icon_black.svg')}}">
                <p class="view-blog-date ml-1">{{$blog->created_at->format('F d, Y')}}</p>
            </div>
            <div class="sharelinks">
                {{-- <a href="#"><img src="{{asset('/images/front-end-icons/twitter_share.svg')}}"></a> --}}
                <a href="https://www.youtube.com/channel/UCePgdCF8oCRXenvvLADp38w/featured" target="_blank"><img src="{{asset('/images/front-end-icons/youtube_share.svg')}}"></a>
                <a href="https://www.instagram.com/mobileswithboo/" target="_blank"><img src="{{asset('/images/front-end-icons/instagram_share.svg')}}"></a>
                <a href="https://www.facebook.com/BambooMobileTech/" target="_blank"><img src="{{asset('/images/front-end-icons/facebook_share.svg')}}"></a>
                <div data-toggle="modal" data-target="#shareModal"><img src="{{asset('/images/front-end-icons/news_share.svg')}}"></div>
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

        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                {{-- <div class="modal-header">
                  <h5 class="modal-title" id="shareModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> --}}
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="btn btn-green w-25 m-4 ml-auto mr-auto" id="sendEmail">Share via Email</div>
                        <div class="btn btn-orange w-25 m-4 mt-0 ml-auto mr-auto" id="copyLink">Copy link</div>
                    </div>

                    <div class="alert alert-success w-50 ml-auto mr-auto text-center notvisible" id="success-copy"><p>Link copied to clipboard.</p></div>
                </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
              </div>
            </div>
          </div>

    </div>

    <div class="blog-horizontal-line"></div>

    @if($blogs->count() > 1)

        <div class="blog-read-more ml-auto mr-auto mt-5">
            <p class="readmore-view-blog mb-4 ml-2">READ MORE</p>

            <div class="news-main-row">

                <div class="news-primary">
                    <a class="news-main-item" href="/news/{{$blogs->first()->id}}">
                        <img class="news-image main" src="{{$blogs->first()->getFirstImage()}}">

                        <div class="mobile-author-tag">
                            <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                            </div>
                            <div class="row m-0 mt-2">
                                <div class="news-author-row mr-2">
                                    <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                    <p class="author-smaller-p">{{$blogs->skip(1)->first()->author}}</p>
                                </div>
                                <div class="news-created-at-row ml-4">
                                    <img class="news-created-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                    <p class="created-at-smaller-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="news-content-container">
                            <div @if($blogs->first()->cms_type === 0) class="news-tag mobile-hidden" @elseif($blogs->first()->cms_type === 1) class="blog-tag mobile-hidden" @else class="how-to-tag mobile-hidden" @endif>
                                <p class="tag-content">@if($blogs->first()->cms_type === 0) NEWS @elseif($blogs->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                            </div>
                            <div class="news-title main mt-2">
                                <p>{{$blogs->first()->cms_title}}</p>
                            </div>
                            <div class="row m-0 mt-2 mobile-hidden">
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

                            <div class="mobile-author-tag">
                                <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2">
                                        <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-smaller-p">{{$blogs->skip(1)->first()->author}}</p>
                                    </div>
                                    <div class="news-created-at-row ml-4">
                                        <img class="news-created-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-smaller-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="news-content-container smaller-pad">
                                <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag mobile-hidden" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag mobile-hidden" @else class="how-to-tag mobile-hidden" @endif>
                                    <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="news-smaller-title main mt-2">
                                    <p>{{$blogs->skip(1)->first()->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2 mobile-hidden">
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

                            <div class="mobile-author-tag">
                                <div @if($blogs->skip(1)->first()->cms_type === 0) class="news-tag" @elseif($blogs->skip(1)->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs->skip(1)->first()->cms_type === 0) NEWS @elseif($blogs->skip(1)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="row m-0 mt-2">
                                    <div class="news-author-row mr-2">
                                        <img class="news-user-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}">
                                        <p class="author-smaller-p">{{$blogs->skip(1)->first()->author}}</p>
                                    </div>
                                    <div class="news-created-at-row ml-4">
                                        <img class="news-created-smaller-icon mr-2" src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}">
                                        <p class="created-at-smaller-p">{{$blogs->skip(1)->first()->created_at->format('F d, Y')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="news-content-container smaller-pad">
                                <div @if($blogs->skip(2)->first()->cms_type === 0) class="news-tag mobile-hidden" @elseif($blogs->skip(2)->first()->cms_type === 1) class="blog-tag mobile-hidden" @else class="how-to-tag mobile-hidden" @endif>
                                    <p class="tag-content">@if($blogs->skip(2)->first()->cms_type === 0) NEWS @elseif($blogs->skip(2)->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="news-smaller-title main mt-2">
                                    <p>{{$blogs->skip(2)->first()->cms_title}}</p>
                                </div>
                                <div class="row m-0 mt-2 mobile-hidden">
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

    {{-- @if(count($howto) > 1)
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
    @endif --}}

    @include('partial.newscontactsupport')

    @include('partial.newsletter')

    @include('customer.layouts.footer', ['showGetstarted' => false])
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

    document.getElementById("copyLink").addEventListener('click', function(){
        const dummy = document.createElement('p');
        dummy.textContent = window.location.href;
        document.body.appendChild(dummy);

        const range = document.createRange();
        range.setStartBefore(dummy);
        range.setEndAfter(dummy);

        const selection = window.getSelection();
        // First clear, in case the user already selected some other text
        selection.removeAllRanges();
        selection.addRange(range);

        document.execCommand('copy');
        document.body.removeChild(dummy);

        let infomsg = document.getElementById('success-copy');

        infomsg.classList.remove('notvisible');
        setTimeout(() => {
            infomsg.classList.add('notvisible');
        }, 3000);
        setTimeout(() => {
            $('#shareModal').modal('hide')
        }, 3500);
    });

    document.getElementById('sendEmail').addEventListener('click', function(){
        window.location.href = "mailto:?subject=Bamboo Mobile - {!!$blog->cms_title!!}&body="+window.location.href;
        setTimeout(() => {
            $('#shareModal').modal('hide')
        }, 3000);
    });
</script>

@endsection