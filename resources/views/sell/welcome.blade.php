<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        
        <title>Bamboo Mobile::Recycle</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    </head>

    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            @include('customer.layouts.sellinglinks')

            <div class="sell-title-container">
                <p class="sell-title">What do you want to sell?</p>
                <p class="sell-subtitle mb-5 mt-4">Please use the search bar below or follow the steps to find your device</p>

                <div class="sell-search-container">
                    <div class="search-bar">
                        <form id="search-form" class="search-column-wrap" action="/sell/searchproducts" method="POST">
                            @csrf
                            <div class="sell-searchfield">
                                <input class="search-sell-input" id="searchSellDevices" type="text" name="search_argument" placeholder="Enter the make or model of your device">
                                <div class="search-sell-btn"><img class="sell-search-icon" src="{{asset('/images/front-end-icons/search_icon.svg')}}"></div>
                            </div>
                            <div id="selling-search-results" class="nomatches">
                                {{-- <div class="selling-single-result"><p>Iphone X</p></div>
                                <div class="selling-single-result"><p>Iphone S</p></div>
                                <div class="selling-single-result"><p>Iphone Z</p></div> --}}
                                <div id="no-results-sorry" class="noresults">
                                    <img class="sorry-result-img" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                                    <p class="sorry-result-text">We are sorry Boo is unable to find this make/model, please contact Customer Support on <a href="mailto:customersupport@bamboomobile.co.uk">customersupport@bamboomobile.co.uk</a></p>
                                </div>
                            </div>
                        </form>
                        {{-- <a href=""><div class="d-flex mt-50">
                            <p>How do I find the model, IMEI or Serial Number</p>
                            <img src="{{asset('/images/front-end-icons/search_icon.svg')}}">
                        </div></a> --}}
                    </div>
                </div>
            </div>

            <div class="col">
                <p class="sell-subtitle mt-4">OR</p>
                <p class="sell-subtitle mb-2 mt-4">Step 1: Select your device below</p>
            </div>

            <div class="sell-categories-container">

                <div class="single-sell-category" onclick="selectCategory('mobile')" id="mobile-category">
                    <p class="sell-category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-mobile">
                        <img src="{{asset('/shop_images/category-image-1.png')}}">
                    </div>
                    <div class="selected-category" id="selected-mobile">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

                <div class="single-sell-category" onclick="selectCategory('tablets')" id="tablets-category">
                    <p class="sell-category-title">Tablets</p>
                    <div class="rounded-background-image" id="rounded-tablets">
                        <img src="{{asset('/shop_images/category-image-2.png')}}">
                    </div>
                    <div class="selected-category" id="selected-tablets">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

                <div class="single-sell-category" onclick="selectCategory('watches')" id="watches-category">
                    <p class="sell-category-title">Watches</p>
                    <div class="rounded-background-image" id="rounded-watches">
                        <img src="{{asset('/shop_images/category-image-3.png')}}">
                    </div>
                    <div class="selected-category" id="selected-watches">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

            </div>

            <div id="device-makes" class="device-makes-container hidden">
                <p class="sell-subtitle mb-5 mt-4">Step 2: Select the make of your device</p>

                <div class="device-brands-row">
                    @foreach($brands as $brand)
                        <div class="device-brand" id="brand-{{$brand->id}}" onclick="selectBrand('{!!$brand->id!!}')">
                            <img src="{{asset('images/brands/'.$brand->brand_image)}}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="device-makes-results" class="hidden">
            </div>

            <div class="selling-info-items-container">
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-1.svg')}}">
                    <p class="selling-info-bold-text mt-4">SAME DAY PAYMENT</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-2.svg')}}">
                    <p class="selling-info-bold-text mt-4">FREE POSTAGE</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-3.svg')}}">
                    <p class="selling-info-bold-text mt-4">DATE IS ALWAYS PROTECTED</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-4.svg')}}">
                    <p class="selling-info-bold-text mt-4">BAMBOO PRICE OR YOUR DEVICE BACK FREE</p>
                </div>
            </div>

            <div class="home-element about-container">
                <div class="about-top-container">
                    <div class="about-element-container">
                        <div class="center-title-container">
                            <p>About bamboo</p>
                        </div>
                        <p class="about-bamboo-text">Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.</p>
                        <div class="grading-show-more-container">
                            <a href="#"><div class="grading-show-more-btn">
                                <p>Read More</p>
                            </div></a>
                        </div>    
                    </div>
            
                    <div class="about-image-container">
                        <div class="about-image">
                            <img src="{{asset('/images/bamboo-laughing.gif')}}">
                        </div>
                    </div>
                </div>

                <div class="about-bottom-container">
                    <div class="about-images-container">
                        <div class="about-images" id="top-image">
                            <img src="{{asset('/images/ss-img-1.svg')}}">
                        </div>
                        <div class="about-images" id="bottom-image">
                            <img src="{{asset('/images/ss-img-2.svg')}}">
                        </div>
                    </div>

                    <div class="sustainability-element-container">
                        <div class="center-title-container">
                            <p>Sustainability</p>
                        </div>
                        <p class="about-bamboo-text">Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy. </p>
                        <div class="grading-show-more-container">
                            <a href="#"><div class="grading-show-more-btn">
                                <p>Read More</p>
                            </div></a>
                        </div>   
                    </div>
                </div>
            </div>

            <div class="selling-service-container">
                <div class="selling-service-container-image">
                    <img src="{{asset('/customer_page_images/body/Icon-Trust.svg')}}">
                </div>
                <div class="selling-service-container-text">
                    <p class="service-header-1" >Service & Support</p>
                    <p class="service-header-2">A lot of our queries can be found within our Service & Support section</p>
                </div>
                <div class="selling-service-container-arrow">
                    <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </div>
            </div>

            <div class="home-element home-links-container">
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="news">
                            <p>News & Blog</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-1.svg')}}">
                        </div>
                    </a>
                </div>
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="service">
                            <p>Service & Support</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-2.svg')}}">
                        </div>
                    </a>
                </div>
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="contact">
                            <p>Contact us</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-3.svg')}}">
                        </div>
                    </a>
                </div>
        
            </div>

            <div class="home-element sign-up">
        
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
        
            </div>


            @if(session('showLogin') || $errors->all())
                <script>
                    $(window).on('load',function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-first-element">
                                <div class="register-elements-container">
                                    <h3>New Customers</h3>
                                    <button onclick="showRegistrationForm()" class="btn btn-primary">
                                        Sign up
                                    </button>
                                </div>

                                <div class="login-form-container">
                                    <h3>Sign in</h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username or Email" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-0" style="display:flex; flex-direction: row; justify-content:space-between; align-items:center;">
                                            @if (Route::has('password.request'))
                                                <a class="btn-link" style="color: #000; margin:0;" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>    
                                    </form>
                                </div>
                            </div>
                            <div class="modal-second-element">
                                <div class="register-form-container">
                                    @include('auth.register')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>@include('customer.layouts.footer')</footer>
        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }


            document.getElementById('searchSellDevices').addEventListener('keyup', function(e){
                //setTimeout(() => {
                    let val = document.getElementById('searchSellDevices').value;
                    let resultsdiv = document.getElementById("selling-search-results");
                    let noresults = document.getElementById("no-results-sorry");

                    if(val){
                        $.ajax({
                            type: "POST",
                            url: '/sell/searchdevices',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                term: val,
                            },
                            success: function(data, textStatus, jqXHR){
                                $('.selling-single-result').remove();

                                if(resultsdiv.classList.contains('nomatches')){
                                    resultsdiv.classList.remove('nomatches');
                                }
                                if(!noresults.classList.contains('hidden')){
                                    noresults.classList.add('hidden');
                                }

                                if(jqXHR.status === 200){
                                    
                                    if(data.length > 0){

                                        $('.selling-single-result').remove();

                                        for (let index = 0; index < data.length; index++) {
                                            let singleresult = data[index];

                                            let singledevice = document.createElement('div');
                                            singledevice.classList.add('selling-single-result');
                                            let devicename = document.createElement('p');
                                            devicename.innerHTML = singleresult.product_name;
                                            singledevice.appendChild(devicename);
                                            singledevice.onclick = function(){
                                                window.location = '/sell/shop/item/'+singleresult.id;
                                            }

                                            resultsdiv.appendChild(singledevice);
                                        }
                                    } else {
                                        if(noresults.classList.contains('hidden')){
                                            noresults.classList.remove('hidden');
                                        }
                                    }

                                } else {
                                    if(!resultsdiv.classList.contains('nomatches')){
                                        resultsdiv.classList.add('nomatches');
                                    }
                                    if(!noresults.classList.contains('hidden')){
                                        noresults.classList.add('hidden');
                                    }
                                }
                            },
                        });
                    } else {
                        if(!resultsdiv.classList.contains('nomatches')){
                            resultsdiv.classList.add('nomatches');
                        }
                    }
                   
                //}, 500);
            })


            function selectCategory(category){
                // clear results
                $('.device-make-result').remove();

                let makes = document.getElementById('device-makes');
                if(makes.classList.contains('hidden')){
                    makes.classList.remove('hidden');
                }
                let mobile = document.getElementById('selected-mobile');
                let tablets = document.getElementById('selected-tablets');
                let watches = document.getElementById('selected-watches');

                let mobile_category = document.getElementById('mobile-category');
                let tablets_category = document.getElementById('tablets-category');
                let watches_category = document.getElementById('watches-category');

                switch (category) {
                    case 'mobile':
                        mobile.classList.add('selected-category');
                        tablets.classList.remove('selected-category');
                        watches.classList.remove('selected-category');

                        mobile.style.display = 'flex';
                        tablets.style.display = 'none';
                        watches.style.display = 'none';

                        mobile_category.style.filter =  'opacity(1)';
                        tablets_category.style.filter =  'opacity(0.5)';
                        watches_category.style.filter =  'opacity(0.5)';
                        break;

                    case 'tablets':
                        mobile.classList.remove('selected-category');
                        tablets.classList.add('selected-category');
                        watches.classList.remove('selected-category');

                        mobile.style.display = 'none';
                        tablets.style.display = 'flex';
                        watches.style.display = 'none';

                        mobile_category.style.filter =  'opacity(0.5)';
                        tablets_category.style.filter =  'opacity(1)';
                        watches_category.style.filter =  'opacity(0.5)';
                        break;

                    case 'watches':
                        mobile.classList.remove('selected-category');
                        tablets.classList.remove('selected-category');
                        watches.classList.add('selected-category');

                        mobile.style.display = 'none';
                        tablets.style.display = 'none';
                        watches.style.display = 'flex';

                        mobile_category.style.filter =  'opacity(0.5)';
                        tablets_category.style.filter =  'opacity(0.5)';
                        watches_category.style.filter =  'opacity(1)';
                        break;
                
                    default:
                        break;
                }
            }

            function selectBrand(id){
                let category_name = document.getElementsByClassName('selected-category')[0].id.split('-')[1];
                let category;
                switch (category_name) {
                    case 'mobile':
                        category = 1;
                        break;
                    case 'tablets':
                        category = 2;
                        break;
                    case 'watches':
                        category = 3;
                        break;
                    default:
                        break;
                }

                $('.device-brand').removeClass('selected');
                $('.device-brand').css('filter', 'opacity(0.3)');
                let brand = document.getElementById('brand-'+id);
                brand.classList.add('selected');
                brand.style = 'filter: opacity(1)';

                $('.device-brand').removeClass('selected');

                $('.device-make-result').remove();

                let devicemakeresults = document.getElementById("device-makes-results");
                if(devicemakeresults.classList.contains('hidden')){
                    devicemakeresults.classList.remove('hidden');
                }

                $.ajax({
                    type: "GET",
                    url: '/sell/getdevicebybrand/'+id+'/'+category,
                    success: function(data, textStatus, jqXHR){
                        if(jqXHR.status === 200){
                            if(data.length > 0){

                                for (let index = 0; index < data.length; index++) {
                                    let singleresult = data[index];

                                    let singledeviceresult = document.createElement('div');
                                    singledeviceresult.classList.add('device-make-result');

                                    let deviceimg = document.createElement('img');
                                    deviceimg.classList.add('device-make-result-image');
                                    deviceimg.src = 'http://127.0.0.1:8000/images/placeholder_phone_image.png';

                                    let devicename = document.createElement('p');
                                    devicename.classList.add('device-make-result-name');
                                    devicename.innerHTML = singleresult.product_name;

                                    let selecttoggle = document.createElement('img');
                                    selecttoggle.src = '/images/front-end-icons/purple_circle.svg';
                                    selecttoggle.classList.add('select-make-result-device');
                                    selecttoggle.classList.add('mt-4');

                                    let infotext = document.createElement('p');
                                    infotext.classList.add('mt-3');
                                    infotext.innerHTML = 'Select this model';

                                    singledeviceresult.onclick = function(){
                                        window.location = '/sell/shop/item/'+singleresult.id;
                                    }

                                    singledeviceresult.appendChild(deviceimg);
                                    singledeviceresult.appendChild(devicename);
                                    singledeviceresult.appendChild(selecttoggle);
                                    singledeviceresult.appendChild(infotext);

                                    devicemakeresults.appendChild(singledeviceresult);
                                }
                            } else {
                                // if(noresults.classList.contains('hidden')){
                                //     noresults.classList.remove('hidden');
                                // }
                            }

                        } else {}
                    },
                });
            }
        </script>
    </body>
</html>