@extends('customer.layouts.layout')

@section('content')        

    <main class="selling-margin">
        @include('customer.layouts.sellinglinks')
        <div class="col text-center sell-item">
            @if(Session::get('_previous') !== null)
                <a class="back-results-sell sell-item-back  ml-5" href="{{Session::get('_previous')['url']}}">
            @else
                <a class="back-results-sell sell-item-back  ml-5" href="/sell">
            @endif
                <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                <p class="results-back selling">Back to Search</p>
            </a>
        </div>

        <div class="single-product-container">
            {{-- {!!dd($product)!!} --}}
            <div class="product-image-container">
                @if($product->product_image === 'default_image')
                    <img src="{{asset('/images/placeholder_phone_image.png')}}">
                @else
                    <img src="{{asset('/storage/product_images').'/'.$product->product_image}}">
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

                        <div class="d-flex">
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
                            <a role="button" class="my-auto ml-0" data-toggle="modal" data-target="#gradesModal">
                                <label class="d-flex ml-0 mr-3 my-auto cursor-pointer">
                                    <img class="grades-info-img" src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mx-3">
                                    <p class="infotext-sell-item">What do these grades mean?</p>
                                </label>
                            </a>
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
                            <button id="addToCart" type="submit" class="btn start-selling sellitem"><p>Sell my device</p></button>
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

                            <div class="row m-0">
                                <div class="col p-0">
                                    <label for="email_address" class="select-shopping-option-title m-0 mb-1">Email address*</label>
                                    @if(Session::has('session_email'))
                                        <input type="email" id="basket_email" class="mb-0 sell-email-input" value="{!!Session::get('session_email')!!}" required name="email"/>
                                    @else
                                        <input type="email" id="basket_email" class="mb-0 sell-email-input" required name="email"/>
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

                @endif
            </div>
        </div>
        
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
            <script>
                window.addEventListener('DOMContentLoaded', function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif

        <div class="modal fade" id="gradesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header grades border-0">
                        <p class="grades-info-header-text">Select condition</p>
                        <div class="close-grades-box">
                            <button type="button" class="close close-grades-modal-button" data-dismiss="modal" aria-label="Close">
                                <img class="close-grades-img" src="{{ url('/images/front-end-icons/close_modal_orange.svg') }}">
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="grades-toggle-items">
                            <div class="toggle-grade-section selected-grade mr-2 ml-1" id="toggle-excellent">Excellent working</div>
                            <div class="toggle-grade-section ml-2 mr-2" id="toggle-good">Good working</div>
                            <div class="toggle-grade-section ml-2 mr-2" id="toggle-poor">Poor working</div>
                            <div class="toggle-grade-section ml-2 mr-2" id="toggle-damaged">Damaged working</div>
                            <div class="toggle-grade-section ml-2 mr-1" id="toggle-faulty">Faulty</div>
                        </div>

                        <div class="grades-descriptions">
                            <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc" id="excellent-description">
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Very Minimal wear and tear is acceptable with no marks to LCD screen</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                </div>
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be fully working</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                </div>
                            </div>

                            <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="good-description">
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Minor wear and tear is acceptable</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                </div>
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be fully working</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items</p>
                                </div>
                            </div>

                            <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="poor-description">
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Mid / Heavy wear and tear is acceptable </p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                </div>
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be fully working</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                </div>
                            </div>

                            <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="damaged-description">
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Mid / Heavy wear and tear is acceptable (i.e. heavy scratches or small dents) </p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Only physical damage acceptable are cracked or chipped digitiser or glass back</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                </div>
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be fully working</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                </div>
                            </div>

                            <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="faulty-description">
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is NOT fully functional</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Heavy wear and tear is acceptable (i.e. heavy scratches or small dents)</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">All components must be intact and device cannot be snapped into pieces</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Significant physical damage / Water damage</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Dust under screens or cameras</p>
                                </div>
                                <div class="grade-desc-column">
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID does not work</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Software faulty</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Accept Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Accept Knox disabled</p>
                                    <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

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


        let buttons = document.getElementsByClassName('toggle-grade-section');
        for (let index = 0; index < buttons.length; index++) {
            let button = buttons[index];
            button.onclick = function() {changeGradeSection(button.id)};
        }

        function changeGradeSection(id){
            let btn = document.getElementById(id);
            let splitted = id.split('-');
            let section = splitted[1];
            let section_container = document.getElementById(section+'-description')
            if(btn.classList.contains('selected-grade')){
                
            } else {
                $('.toggle-grade-section').removeClass('selected-grade');
                $('.grade-section-description').addClass('hidden');

                btn.classList.add('selected-grade');
                section_container.classList.remove('hidden');
            }
        }

    </script>

@endsection