@extends('customer.layouts.layout')

@section('content')        

    <main class="selling-margin @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif">
        @include('customer.layouts.sellinglinks')
        {{-- <div class="col text-center sell-item">
            @if(Session::get('_previous') !== null)
                <a class="back-results-sell sell-item-back  ml-5" href="{{Session::get('_previous')['url']}}">
            @else
                <a class="back-results-sell sell-item-back  ml-5" href="/sell">
            @endif
                <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                <p class="results-back selling">Back to Search</p>
            </a>
        </div> --}}
        @if(Session::get('_previous') !== null)
            <a class="back-to-home-footer padded mt-3 pt-2" href="{{Session::get('_previous')['url']}}">
        @else
            <a class="back-to-home-footer padded mt-3 pt-2" href="/">
        @endif
            <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
            <p class="back-home-text">Back</p>
        </a>

        <div class="single-product-container">
            {{-- {!!dd($product)!!} --}}
            <div class="product-image-container">
                @if($product->product_image === 'default_image')
                    <img src="{{asset('/images/placeholder_phone_image.png')}}">
                @else
                    {{-- <img src="{{asset('/storage/product_images').'/'.$product->product_image}}"> --}}
                    <img src="{{$product->getImage()}}">
                @endif
            </div>
            <div class="product-data">
                <div class="product-selected product-name-container">
                    <p class="product-title">{{$product->product_name}}</p>
                </div>

                @if(!$networks->isEmpty())
                    <div class="product-selected product-network-container" id="product-network-container">
                        <div class="row m-0">
                            <p class="select-shopping-option-title m-0 mb-1">Select Network:</p>
                            <p id="selected-network"></p>
                        </div>

                        <div class="networks-container">
                        @foreach($networks as $network)
                            <div class="mb-2"><label class="network-container mr-3" id="{{$network->getNetWorkName($network->network_id)}}" for="network-{{$network->id}}"><img src="{{$network->getNetWorkImage($network->network_id)}}"></label></div>
                        @endforeach
                        </div>

                        <div class="d-flex">
                        @foreach($networks as $network)
                            <input class="device-network" id="network-{{$network->id}}" name="network" value="{{$network->knockoff_price}}" onchange="networkChanged(this)" type="radio">
                        @endforeach
                        </div>

                        <div id="please-select-network" class="alert alert-danger pleaseSelect invisible"><p>Please complete network field to proceed.</p></div>
                    </div>
                @else
                    <div class="row m-0">
                        <p class="select-shopping-option-title m-0 mb-1">Network:</p>
                        <div id="selected-network">This device has no network.</div>
                    </div>
                    <div class="d-flex">
                        <img class="no-network" src="{{asset('/images/front-end-icons/non_cellular.png')}}">
                    </div>
                @endif
                
                @if(!$productInformation->isEmpty())
                    <div class="product-selected product-memory-container">
                        <div class="row m-0">
                            <p class="select-shopping-option-title m-0 mb-1">Select Memory:</p>
                            <p id="selected-gb"></p>                           
                        </div>

                        <div class="d-flex memory-options-container">

                        @foreach($productInformation as $info)
                            
                            <div id="memory-box-{{$info->memory}}" class="device-memory"><label class="memory-container mr-3" id="{{$info->memory}}" for="info-{{$info->id}}">{{$info->memory}}</label></div>
                        @endforeach
                        </div>

                        <div class="d-flex">
                        @foreach($productInformation as $info)
                            <input id="info-{{$info->id}}" name="info" value='{ "price1": {{$info->excellent_working}}, "price2": {{$info->good_working}}, "price3": {{$info->poor_working}}, "price4": {{$info->damaged_working}}, "price5": {{$info->faulty}}}' type="radio" onchange="memoryChanged(this)">
                        @endforeach
                        </div>

                        <div id="please-select-memory" class="alert alert-danger pleaseSelect invisible mt-2"><p>Please complete memory field to proceed.</p></div>
                    </div>
                @endif

                <div class="product-selected product-grade-container selling-item-grades-container">
                    <div class="row m-0">
                        <p class="select-shopping-option-title m-0 mb-1">Select Grade:</p>
                        <p id="selected-grade"></p>
                    </div>

                    <div class="">
                        <div class="d-flex grade-options-container" id="grades-text">
                            <label class="elem-grade-container ml-0 mr-3" id="grade-1-text" for="grade-1">Excellent Working</label>
                            <label class="elem-grade-container ml-0 mr-3" id="grade-2-text" for="grade-2">Good Working</label>
                            <label class="elem-grade-container ml-0 mr-3" id="grade-3-text" for="grade-3">Poor Working</label>
                            <label class="elem-grade-container ml-0 mr-3" id="grade-4-text" for="grade-4">Damaged Working</label>
                            <label class="elem-grade-container ml-0 mr-3" id="grade-5-text" for="grade-5">Faulty</label>
                        </div>
                        <div class="row m-0 mt-2">
                            @include('partial.gradesmodal')
                        </div>
                    </div>
                
                    <div class="d-flex selling-item-grades-container">
                        <input id="grade-1" name="grade" type="radio" value="1" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        <input id="grade-2" name="grade" type="radio" value="2" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        <input id="grade-3" name="grade" type="radio" value="3" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        <input id="grade-4" name="grade" type="radio" value="4" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        <input id="grade-5" name="grade" type="radio" value="5" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                    </div>

                    <div id="please-select-grade" class="alert alert-danger pleaseSelect invisible"><p>Please complete grade field to proceed.</p></div>
                </div>

                <div class="d-flex">
                    <div class="d-flex flex-column mb-1">
                        <p class="infotext-sell-item">You don't need to send your charger, accessories or the original box!</p>
                    </div>
                </div>

                @if(str_contains(strtolower($product->product_name), 'samsung galaxy note'))
                    <div class="d-flex flex-column mb-2 samsung-note-alert">
                        <p class="infotext-sell-item bold">Please remember to include your stylus with the Note></p>
                    </div>
                @endif

                {{-- <div class="d-flex">
                    <div class="d-flex flex-column">
                        <p>Do you have a smartphone to trade in? You could save up to £320*</p>
                        <a href="" class="my-auto mx-0"><label class="ml-0 mr-3 my-auto"><img src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mr-3">How does this work?</label></a>
                    </div>
                </div> --}}


                <div class="">
                
                    <a class="link-small" href=""><p class="infotext-sell-item border-bottom mt-2">Reset filters</p></a>

                </div>

                <div class="product-selected product-price-container">
                    <p id="product-price">

                    </p>
                </div>


                @if(Auth::user())
                <div class="add-to-container">
                    <form action="/sell/shop/item/addtocart" id="selldeviceform" method="POST">
                        <div class="add-to-cart-container">
                            @csrf
                            <input type="hidden" name="productid" value="{{$product->id}}">
                            <input type="hidden" name="grade" id="grade"></input>
                            <input type="hidden" name="network" id="network"></input>
                            <input type="hidden" name="memory" id="memory"></input>
                            <input type="hidden" name="price" id="price"></input>
                            <input type="hidden" name="type" value="tradein"></input>
                            <button id="addToCart" type="submit" class="btn start-selling sellitem fullwidth"><p>Sell my device</p></button>
                        </div>
                    </form>

                </div>
                
                @if(Session::has('productaddedtocart'))
                    <p class="green-success mt-4">Product has been added to basket. </p>
                @endif

                @else
                <div class="add-to-container">
                    <form action="/sell/shop/item/addtocart"  id="selldeviceform" method="POST">

                        <div class="add-to-cart-container">
                            @csrf
                            <input type="hidden" name="productid" value="{{$product->id}}">
                            <input type="hidden" name="grade" id="grade"></input>
                            <input type="hidden" name="network" id="network"></input>
                            <input type="hidden" name="memory" id="memory"></input>
                            <input type="hidden" name="price" id="price"></input>
                            <input type="hidden" name="type" value="tradein"></input>

                            <div class="row m-0 email-abandoned-basket">
                                <div class="col p-0">
                                    <label for="email_address" class="select-shopping-option-title m-0 mb-1">Email address*</label>
                                    @if(Session::has('abandoned_email'))
                                        <input type="email" id="basket_email" class="mb-0 sell-email-input" value="{!!Session::get('abandoned_email')!!}" required name="abandoned_email"/>
                                    @else
                                        <input type="email" id="basket_email" class="mb-0 sell-email-input" required name="abandoned_email"/>
                                    @endif
                                </div>
                                <button id="addToCart" type="submit" class="btn start-selling sellitem-small mt-auto ml-2"><p>Sell my device</p></button>
                            </div>
                            <div id="please-enter-email" class="alert alert-danger pleaseSelect invisible mt-2"><p>Please complete email field to proceed.</p></div>
                            
                        </div>

                    </form>

                </div>

                @if(Session::has('productaddedtocart'))
                    <p class="green-success mt-4">Product has been added to basket. </p>
                @endif

                @if($errors->has('abandoned_email'))
                    @error('abandoned_email')
                        <div class="alert alert-danger col-9">Please input valid email address.</div>
                    @enderror
                @endif

                @endif
            </div>
        </div>

        {{-- <pre>{{var_dump(request()->session()->all())}}</pre> --}}
        
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
        </div>
        <div class="shop-spilt">
            <div class="shop-split-image">
                <img src="{{asset('/shop_images/shop_split_image.png')}}">
            </div>
            <div class="shop-split-text">
                <div class="shop-split-text-container">
                    <p class="shop-title">Spoilt for choice?</p>
                    <p class="category-title">Use our handy comparison tool <br> to find the best option for you.</p>
                </div>
                <div class="shop-split-arrow">
                    <img src="">
                </div>
            </div>
        </div> --}}

        @include('partial.whathappensnext')

        @include('partial.sustainability', ['whySell' => false, 'about' => false])

        @include('partial.newsletter')

        @if(Session::has('useralreadyexists'))
            <script>
                window.addEventListener('DOMContentLoaded', function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif

        @if(session('showLogin') || $errors->all())
            @if(!$errors->has('abandoned_email'))
                <script>
                    window.addEventListener('DOMContentLoaded', function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif
        @endif

    </main>

    <footer>@include('customer.layouts.footer', ['showGetstarted' => false])</footer>
    <script src="{{asset('js/Price.js')}}"></script>
    <script src="{{asset('/js/SellingPage.js')}}"></script>
    <script>

        function showRegistrationForm(){
            if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
            }
        }
        // document.getElementById('registerBtn').addEventListener('click', function(){
        //     document.getElementById('loginModal').classList.remove('noscrolly');
        // })

        function showModal(){
            $('#loginModal').modal('show');
        }

    </script>

@endsection