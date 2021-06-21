@extends('customer.layouts.layout')

@section('content')   

    <main class="selling-margin">
        @include('customer.layouts.sellinglinks')
        {{-- <div class="assurance-container">
            <div class="assurance-element">
                <img src="{{asset('/customer_page_images/body/Assurance-image-1.svg')}}">
                <p>FREE NEXT DAY NATIONWIDE DELIVERY</p>
            </div>
            <div class="assurance-element">
                <img src="{{asset('/customer_page_images/body/Assurance-image-2.svg')}}">
                <p>BAMBOO QUALITY APPROVED OVER 100 FUNCTIONAL CHECKS</p>
            </div>
            <div class="assurance-element">
                <img src="{{asset('/customer_page_images/body/Assurance-image-3.svg')}}">
                <p>NO QUIBBLE MONEY BACK</p>
            </div>
            <div class="assurance-element">
                <img src="{{asset('/customer_page_images/body/Assurance-image-4.svg')}}">
                <p>12 MONTH GUARANTEE</p>
            </div>
        </div> --}}
        <div class="col text-center back-results-selling">
            {{-- @if(Session::get('_previous') !== null)
                <a class="back-results-sell ml-5" href="{{Session::get('_previous')['url']}}">
                    <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="results-back">Back</p>
                </a>
            @else
                <a class="back-results-sell ml-5" href="/sell">
                    <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="results-back">Back</p>
                </a>
            @endif --}}
            @if(Session::get('_previous') !== null)
            <a class="back-to-home-footer padded mt-3 pt-2" href="{{Session::get('_previous')['url']}}">
            @else
                <a class="back-to-home-footer padded mt-3 pt-2" href="/">
            @endif
                <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
                <p class="back-home-text">Back</p>
            </a>
            @if($topResults)
                <p class="results-upper mb-2">search results</p>
                <p class="results-found mb-3">{{$products->count()}} Matching devices found</p>
                @if($products->count() > 0)
                    <p class="results-info mb-2">Click on one to see how much it is worth</p>
                @endif
            @else
                @if(!in_array($parameter, ['mobile', 'tablets', 'watches']))
                    <p class="results-upper mb-3">search results for "{!!$parameter!!}"</p>
                @else
                    @if($parameter === 'mobile')
                        <p class="results-found mb-3">Mobile phones</p>
                    @else
                        <p class="results-found mb-3">{!!ucfirst($parameter)!!}</p>
                    @endif
                @endif
            @endif
            
        </div>

        <div class="d-flex p-5">
            

            {{-- <div class="sidebar w-25">

                <div class="sidebar-element d-flex">
                    <p>View:</p>
                    <select id="number_select" class="form-control w-50" >
                        <option value="&number=24">24 items</option>
                        <option value="&number=36">36 items</option>
                        <option value="&number=48">48 items</option>
                        <option value="&number=60">60 items</option>
                    </select>

                </div>

                <div class="sidebar-element d-flex">
                    <p>Category:</p>
                    <p>@if($category=='mobile') Mobile Phones @elseif($category=='tablets') Tablets @elseif($category=='watches') Smartwatches @endif</p>
                </div>

                <div class="sidebar-element d-flex" >
                    <p>View:</p>
                    <select id="brand_select" class="form-control w-50">
                        @foreach($brands as $brand)
                            <option value="&brand={{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>

                </div>

            </div> --}}

            <div class="products d-flex flex-wrap w-100">
                @foreach($products as $product)

                    {{-- <a href="/sell/shop/item/{{$product->id}}"> --}}
                    <a href="{{route('showSellItem', ['parameter' => $product->id])}}">

                        <div class="product">
                            <div class="selling-product-image-container">
                                @if($product->product_image === 'default_image')
                                    <img src="{{asset('/images/placeholder_phone_image.png')}}">
                                @else
                                    {{-- <img src="{{asset('/storage/product_images').'/'.$product->product_image}}"> --}}
                                    <img src="{{$product->getImage()}}">
                                @endif
                            </div>
                            <div class="product-data-container">
                                <h5>{{$product->product_name}}</h5>
                            </div>
                            <div class="go-to-selldevice mt-4">
                                <img class="next-icon-results" src="{{asset('/images/front-end-icons/purple_arrow_next.svg')}}">
                            </div>

                        </div>

                    </a>

                @endforeach
            </div>

        </div>

        @if($topResults)
            @if($canSeeMore)
                <div class="see-more-sell-devices mb-5">
                    <a class="" href="/sell/shop/{{$parameter}}/all">
                        See more devices
                    </a>
                </div>
            @endif
        @else
            <div class="pages d-flex justify-content-end w-100 p-5">
                {{-- <div class="d-flex">
                    @foreach($pages as $page)
                        <div class="d-flex px-3">
                            <a href="?page={{$page}}">
                                @if($currentpage == $page)
                                <div class="page-number-active">
                                    {{$page}}
                                </div>
                                @else
                                <div class="page-number">
                                    {{$page}}
                                </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>                 --}}
                {{ $products->links('vendor.pagination.selling') }}

            </div>

            {{-- <form id="search-parameters" method="GET" action="/sell/shop/mobile">

                <input type="hidden" name="page" value="{{$currentpage}}">
                <input type="hidden" name="number">
    
            </form> --}}
        @endif


        {{-- <div class="let-footer">
            <div class="contact-footer-image">
                <img src="{{asset('/shop_images/letboo/035.svg')}}">
            </div>
            <div class="contact-footer-text">
                <p class="service-header-1" >Save up to £300</p>
                <p class="service-header-2">By trading in your old device when you make a purchase.</p>
            </div>
            <div class="contact-footer-arrow">
                <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div> --}}

        {{-- <div class="shop-by-category">
            <div class="center-title-container">
                <p>Shop by category</p>
            </div>
            <div class="shop-categories-container">
                <a href="/sell/shop/mobile">
                    <div class="category-container">
                        <p class="shop-title">Shop</p>
                        <p class="category-title">Mobile Phones</p>
                        <div class="rounded-background-image" id="rounded-mobile">
                            <img src="{{asset('/shop_images/category-image-1.png')}}">
                        </div>
                    </div>
                </a>
                <a href="/sell/shop/tablets">
                    <div class="category-container">
                        <p class="shop-title">Shop</p>
                        <p class="category-title">Tablets</p>
                        <div class="rounded-background-image" id="rounded-tablets">
                            <img src="{{asset('/shop_images/category-image-2.png')}}">
                        </div>
                    </div>
                </a>
                <a href="/sell/shop/watches">
                    <div class="category-container">
                        <p class="shop-title">Shop</p>
                        <p class="category-title">Watches</p>
                        <div class="rounded-background-image" id="rounded-watches">
                            <img src="{{asset('/shop_images/category-image-3.png')}}">
                        </div>
                    </div>
                </a>

            </div>
        </div> --}}

        {{-- <div class="home-element sign-up">
    
            <div class="center-title-container">
                <p>Sign up to our newsletter!</p>
            </div>
    
            <div class="text-center-container">
                <p>amazing offers, hints and tips and just awesome-ness</p>
            </div>
    
            <form action="/" method="POST">
                @csrf
    
                <input class="email-input" type="email" placeholder="Enter email address here">
                <input class="email-submit" type="submit" value="Sign me up!">
    
                <div class="terms-container">
                    <input type="checkbox" class="mx-3" id="terms" name="terms" required>
                    <label for="terms">I agree to Bamboo Mobile <a href="/terms">Terms and Conditions</a></label>
                </div>
            </form>
    
        </div> --}}

        @if(session('showLogin') || $errors->all())
            <script>
                window.addEventListener('DOMContentLoaded', function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
    </main>

    @include('partial.newscontactsupport')

    @include('partial.newsletter')

    @include('customer.layouts.footer', ['showGetstarted' => false])

    <script src="{{ asset('js/Shop.js') }}"></script>
    <script src="{{asset('/js/SellingPage.js')}}"></script>

    <script>

        function showRegistrationForm(){
            if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
            }
        }

        window.addEventListener('DOMContentLoaded', function(){
            if(window.location.href.indexOf('number') > -1){
                var param = 'number';
                var url = window.location.href;
                var tempArray = url.split("?");
                var baseURL = tempArray[1];
                var additionalURL = tempArray[1];
                var temp = "";
                if (additionalURL) {
                    tempArray = additionalURL.split("&");
                    for (var i=0; i<tempArray.length; i++){
                        if(tempArray[i].split('=')[0] == param){
                            $("#number_select").val(tempArray[i].split('=')[1]);
                        }
                    }
                }
            }

            if(window.location.href.indexOf('brand') > -1){
                var param = 'brand';
                var url = window.location.href;
                var tempArray = url.split("?");
                var baseURL = tempArray[1];
                var additionalURL = tempArray[1];
                var temp = "";
                if (additionalURL) {
                    tempArray = additionalURL.split("&");
                    for (var i=0; i<tempArray.length; i++){
                        if(tempArray[i].split('=')[0] == param){
                            $("#brand_select").val(tempArray[i].split('=')[1]);
                        }
                    }
                }
            }
        });

    </script>

@endsection