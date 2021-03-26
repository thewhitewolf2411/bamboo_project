@extends('customer.layouts.layout')

@section('content')
<div class="app">
    <div class="news-page news-title-container">
        <div class="center-title-container">
            <p>News & Blog</p>
        </div>
    </div>

    <div class="container">

        @if(count($blogs) === 0)


        @else

        <div class="row">
            <div class="col-md-8">
                <a href="/news/{{$blogs->first()->id}}">
                    <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs[0]->image_1}}')">
                        <img src="/storage/news_images/{{$blogs->first()->image_1}}" height="100%" style="max-height: 578px; opacity:0">
                        <div class="news-1-content-container">
                            <div @if($blogs->first()->cms_type === 0) class="news-tag" @elseif($blogs->first()->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                <p class="tag-content">@if($blogs->first()->cms_type === 0) NEWS @elseif($blogs->first()->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                            </div>
                            <div class="main-news-title">
                                <p>{{$blogs[0]->cms_title}}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}" width="20px"><p class="author-p">{{$blogs[0]->author}}</p></div>
                                <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}" width="20px"><p class="created-at-p">{{$blogs[0]->created_at}}</p></div>
                                
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                @if(count($blogs)>1)
                <div class="mb-3">
                    <a href="/news/{{$blogs[1]->id}}">
                        <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs[0]->image_1}}')">
                            <img src="/storage/news_images/{{$blogs[1]->image_1}}" style="max-height: 578px; opacity:0; width:100%">
                            <div class="news-1-content-container">
                                <div @if($blogs[0]->cms_type === 0) class="news-tag" @elseif($blogs[0]->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs[1]->cms_type === 0) NEWS @elseif($blogs[1]->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="main-news-title">
                                    <p>{{$blogs[1]->cms_title}}</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}" width="20px"><p class="author-p">{{$blogs[1]->author}}</p></div>
                                    <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}" width="20px"><p class="created-at-p">{{$blogs[1]->created_at}}</p></div>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(count($blogs)>2)
                <div class="mt-3">
                    <a href="/news/{{$blogs[2]->id}}">
                        <div class="news-1-container" style="background-image: url('/storage/news_images/{{$blogs[2]->image_1}}')">
                            <img src="/storage/news_images/{{$blogs[2]->image_1}}" style="max-height: 578px; opacity:0; width:100%">
                            <div class="news-1-content-container">
                                <div @if($blogs[0]->cms_type === 0) class="news-tag" @elseif($blogs[0]->cms_type === 1) class="blog-tag" @else class="how-to-tag" @endif>
                                    <p class="tag-content">@if($blogs[2]->cms_type === 0) NEWS @elseif($blogs[2]->cms_type === 1) BLOG @else HOW TO, WITH BOO @endif</p>
                                </div>
                                <div class="main-news-title">
                                    <p>{{$blogs[0]->cms_title}}</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Account@2x.png')}}" width="20px"><p class="author-p">{{$blogs[2]->author}}</p></div>
                                    <div class="col-md-4"><img src="{{asset('/images/front-end-icons/Icon-Time@2x.png')}}" width="20px"><p class="created-at-p">{{$blogs[2]->created_at}}</p></div>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>

        @endif

        
    </div>

    <div class="home-element home-links-container">
        
        <div class="home-links-element">
            <a href="/news">
                <div class="home-link-container" id="news">
                    <p>News & Blog</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-1.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="/support">
                <div class="home-link-container" id="service">
                    <p>Service & Support</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-2.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="/contact">
                <div class="home-link-container" id="contact">
                    <p>Contact us</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-3.svg')}}">
                </div>
            </a>
        </div>

    </div>
    
</div>

@endsection