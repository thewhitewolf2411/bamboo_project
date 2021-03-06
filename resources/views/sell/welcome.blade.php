@extends('customer.layouts.layout')

@section('content')        

        <main class="selling-margin @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif" id="top">
            @include('customer.layouts.sellinglinks')

            @if(Session::get('_previous') !== null)
                <a class="back-to-home-footer padded mt-3 pt-2" href="{{Session::get('_previous')['url']}}">
            @else
                <a class="back-to-home-footer padded mt-3 pt-2" href="/">
            @endif
                <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
                <p class="back-home-text">Back</p>
            </a>

            @include('partial.sellsearch', ['title' => 'What do you want to sell?', 'info' => 'Please use the search bar below or follow the steps to find your device'])

            <div class="col">
                <p class="sell-subtitle mt-5">OR</p>
                <p class="sell-subtitle mb-5 mt-4">Step 1: Select your device below</p>
            </div>

            <div class="sell-categories-container" id="all-selling-categories">

                <div class="single-sell-category" onclick="selectCategory('mobile')" id="mobile-category">
                    <p class="sell-category-title">Mobile Phones</p>

                    <div class="sell-category-wrapper">
                        <div class="sell-category-device-background" id="rounded-mobile"></div>
                        <img class="sell-category-device-image mobile" src="{{asset('/images/devices/phones.png')}}">

                        <img class="device-shadow mobile" src="{{asset('/images/device_shadow.svg')}}">
                    </div>


                    <div class="selected-category" id="selected-mobile">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}" id="1">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

                <div class="single-sell-category" onclick="selectCategory('tablets')" id="tablets-category">
                    <p class="sell-category-title">Tablets</p>

                    <div class="sell-category-wrapper">
                        <div class="sell-category-device-background" id="rounded-tablets"></div>
                        <img class="sell-category-device-image tablet" src="{{asset('/images/devices/tablets.png')}}">

                        <img class="device-shadow" src="{{asset('/images/device_shadow.svg')}}">
                    </div>


                    <div class="selected-category" id="selected-tablets">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}" id="2">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

                <div class="single-sell-category" onclick="selectCategory('watches')" id="watches-category">
                    <p class="sell-category-title">Watches</p>

                    <div class="sell-category-wrapper">
                        <div class="sell-category-device-background" id="rounded-watches"></div>
                        <img class="sell-category-device-image watch" src="{{asset('/images/devices/watches.png')}}">
                        
                        <img class="device-shadow" src="{{asset('/images/device_shadow.svg')}}">
                    </div>


                    {{-- <div class="rounded-background-image" id="rounded-watches">
                        <img src="{{asset('/shop_images/category-image-3.png')}}">
                    </div> --}}
                    <div class="selected-category" id="selected-watches">
                        <img class="selected-category-img" src="{{asset('/images/front-end-icons/purple_tick_selected.svg')}}" id="3">
                        <p class="mt-1">Selected</p>
                    </div>
                </div>

            </div>

            <div id="device-makes" class="device-makes-container hidden">
                <p class="sell-subtitle mb-5 mt-4">Step 2: Select the make of your device</p>

                <div class="loader invisible" id="selling-category-brands-loader"></div>

                <div class="device-brands-row" id="device-brands-row">
                    {{-- @foreach($brands as $brand)
                        <div class="device-brand" id="brand-{{$brand->id}}" onclick="selectBrand('{!!$brand->id!!}')">
                            <img src="{{asset('images/brands/'.$brand->brand_image)}}">
                        </div>
                    @endforeach --}}
                </div>
            </div>


            <a href="/contact" id="device-make-results-title" class="hidden">
                <p class="sell-subtitle mb-2 mt-5">Step 3: Select your model</p>
                <p class="sell-subtitle-regular mb-5 mt-1">Not sure what model your device is? Don't worry, let us know, we'll be happy to help <img class="sell-icon-covered ml-2" src="{{asset('images/front-end-icons/black_arrow_next.svg')}}"></p>
            </a>

            <div class="loader invisible" id="selling-brand-results-loader"></div>
            
            <div id="device-makes-results" class="hidden">
            </div>

            <div id="sell-this" class="col mb-4 hidden">
                <div class="see-more-sell-devices mb-4">
                    <div class="text-center" onclick="seeAll()">
                        See all devices
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div id="select-sell-this" class="btn sell-this-device btn-light disabled" onclick="sellThis()">
                        <p>Sell this device</p>
                    </div>
                </div>
            </div>

            <div id="no-results-brand" class="text-center mb-5 hidden">
                No results matching this category/brand.
            </div>

            @if(App\Helpers\RecycleOffers::getSellBanner() !== null)
                <a href="{{App\Helpers\RecycleOffers::getLink()}}">
                    <img class="w-100" style="max-height: 320px;" id="selling_banner">
                </a>
            @endif

            <div class="selling-info-items-container">
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-1.svg')}}">
                    <p class="selling-info-bold-text">SAME DAY PAYMENT</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-2.svg')}}">
                    <p class="selling-info-bold-text">FREE POSTAGE</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-3.svg')}}">
                    <p class="selling-info-bold-text">DATA IS ALWAYS<br> PROTECTED</p>
                </div>
                <div class="selling-info-item">
                    <img class="selling-info-img" src="{{asset('/sell_images/image-4.svg')}}">
                    <p class="selling-info-bold-text">BAMBOO PRICE OR YOUR<br> DEVICE BACK FREE</p>
                </div>
            </div>

            @include('partial.sustainability', ['whySell' => true, 'about' => false, 'showStartSelling' => true])

            {{--<div class="selling-service-container">
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
            </div>--}}

            @include('partial.newscontactsupport')

            @include('partial.newsletter')

            @if(session('showLogin') || $errors->all())
                <script>
                    $(window).on('load',function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif

            <div class="modal fade" id="sellingvideomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>
        <script src="{{asset('/js/SellingPage.js')}}"></script>
        <script src="{{asset('/js/isMobile.js')}}"></script>
        <script>
            var selected_category = null;
            var selected_brand = null;

            window.addEventListener('DOMContentLoaded', function(){

                if('{!!App\Helpers\RecycleOffers::getSellBanner()!!}'){
                    let selling_banner = JSON.parse('{!!App\Helpers\RecycleOffers::getSellBanner()!!}');
                    if(selling_banner){
                        const isMobile = checkIsMobile();
                        const userAgent = navigator.userAgent.toLowerCase();
                        const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(userAgent);

                        if(isTablet){
                            document.getElementById('selling_banner').src = selling_banner.tablet;
                            return;
                        }
                        if(isMobile){
                            document.getElementById('selling_banner').src = selling_banner.mobile;
                            return;
                        }

                        document.getElementById('selling_banner').src = selling_banner.desktop;
                    }
                }

                let preselectedCategory = localStorage.getItem('preselectedSellCategory');
                let preselectedBrand = localStorage.getItem('preselectedBrand');
                if(preselectedCategory){
                    selectCategory(preselectedCategory);
                    localStorage.removeItem('preselectedSellCategory');
                    document.getElementById('all-selling-categories').scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});

                    if(preselectedBrand){
                        localStorage.removeItem('preselectedBrand');
                        setTimeout(() => {
                            selectBrand(preselectedBrand)
                        }, 1000);
                    }
                }

                $(".sell-category-wrapper")
                .mouseenter(function() {
                    // background - 1
                    let bg = this.childNodes[1];
                    bg.classList.add('small');
                    // image - 3
                    let img = this.childNodes[3];
                    img.classList.add('enlarged');
                    // shadow - 5
                    let shadow = this.childNodes[5];
                    shadow.classList.add('zoomed');
                })
                .mouseleave(function() {
                    //unfocusCategory(this);
                    // background - 1
                    let bg = this.childNodes[1];
                    bg.classList.remove('small');
                    // image - 3
                    let img = this.childNodes[3];
                    img.classList.remove('enlarged');
                    // shadow - 5
                    let shadow = this.childNodes[5];
                    shadow.classList.remove('zoomed');
                });

                // preselect category/brand || retrieve searched text
                var session_data = JSON.parse('{!!json_encode(Session::all())!!}');
                if(session_data._previous){
                    let previous_url = session_data._previous.url;
                    let parameters = previous_url.split('/');
                    if(parameters.indexOf("topresults") !== -1){;
                        let searched_term = parameters[parameters.indexOf("topresults") - 1];
                        searched_term = searched_term.replace("%20", " ");
                        document.getElementById("searchSellDevices").value = searched_term;
                    } else {
                        if(parameters.indexOf("devices") !== -1){
                            let ref_pos = parameters.indexOf("devices");
                            let category = parameters[ref_pos + 1];
                            let brand_id = parameters[ref_pos + 2];
                            selectCategory(category);
                            selectBrand(brand_id);
                        }
                    }
                }
            });

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

            function selectCategory(category){

                // clear results
                $('.device-make-result').remove();
                $('.device-brand').remove();

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
                        mobile.classList.add('selected-category');
                        tablets.classList.remove('selected-category');
                        watches.classList.remove('selected-category');

                        mobile.style.display = 'flex';
                        tablets.style.display = 'none';
                        watches.style.display = 'none';

                        mobile_category.classList.remove('faded');
                        tablets_category.classList.add('faded');
                        watches_category.classList.add('faded');
                        break;

                    case 'tablets':
                        mobile.classList.remove('selected-category');
                        tablets.classList.add('selected-category');
                        watches.classList.remove('selected-category');

                        mobile.style.display = 'none';
                        tablets.style.display = 'flex';
                        watches.style.display = 'none';

                        mobile_category.classList.add('faded');
                        tablets_category.classList.remove('faded');
                        watches_category.classList.add('faded');
                        break;

                    case 'watches':
                        mobile.classList.remove('selected-category');
                        tablets.classList.remove('selected-category');
                        watches.classList.add('selected-category');

                        mobile.style.display = 'none';
                        tablets.style.display = 'none';
                        watches.style.display = 'flex';

                        mobile_category.classList.add('faded');
                        tablets_category.classList.add('faded');
                        watches_category.classList.remove('faded');
                        break;
                
                    default:
                        break;
                }

                selected_category = category;
                getAvailableBrands(category);
                document.getElementById('selling-category-brands-loader').classList.remove('invisible');

                $('.device-brand').removeClass('selected');
                //$('.device-brand').css('filter', 'opacity(0.3)');

                // mobile TODO
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#all-selling-categories").offset().top + 250
                }, 500);
            }


            function getAvailableBrands(category){
                let brandresults = document.getElementById("device-brands-row");

                $.ajax({
                    type: "GET",
                    url: '/sell/getavailablebrands/'+category,
                    success: function(data, textStatus, jqXHR){
                        for (let index = 0; index < data.length; index++) {
                            let singlebrand = data[index];

                            let singlebrandresult = document.createElement('div');
                            singlebrandresult.classList.add('device-brand');
                            singlebrandresult.id = 'brand-'+singlebrand.id
                            singlebrandresult.title = singlebrand.brand_name;
                            singlebrandresult.onclick = function(){
                                selectBrand(singlebrand.id);
                            }

                            let brandimg = document.createElement('img');
                            brandimg.src = 'images/brands/'+singlebrand.brand_image;

                            singlebrandresult.appendChild(brandimg);

                            brandresults.appendChild(singlebrandresult);
                            //$('.device-brand').css('filter', 'opacity(0.3)');

                        }

                        document.getElementById('selling-category-brands-loader').classList.add('invisible');

                    },
                });
            }


            function selectBrand(id){

                let brand_element = document.getElementById('brand-'+id);
                if(brand_element.classList.contains('selected')){

                    brand_element.classList.remove('selected');

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#all-selling-categories").offset().top - 300
                    }, 500);

                    $('.device-brand').css('filter', 'opacity(1)');
                    $('.device-make-result').remove();
                    $('.device-brand').remove();

                    $('#device-makes').addClass('hidden');
                    $('#device-make-results-title').addClass('hidden');
                    $('#sell-this').addClass('hidden');
                    return;
                }

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
                $('.device-brand').removeClass('selected');
                let brand = document.getElementById('brand-'+id);
                brand.classList.add('selected');
                brand.style = 'filter: opacity(1)';

                // mobile TODO
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#all-selling-categories").offset().top + 850
                }, 500);

                $('.device-make-result').remove();

                let devicemakeresults = document.getElementById("device-makes-results");
                let devicemakeresultstitle = document.getElementById("device-make-results-title");
                document.getElementById('sell-this').classList.add('hidden');
                document.getElementById('no-results-brand').classList.add('hidden');

                if(devicemakeresults.classList.contains('hidden')){
                    devicemakeresults.classList.remove('hidden');
                }
                if(devicemakeresultstitle.classList.contains('hidden')){
                    devicemakeresultstitle.classList.remove('hidden');
                }

                selected_brand = id;

                // show loader
                document.getElementById('selling-brand-results-loader').classList.remove('invisible');

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
                                    if(singleresult.device_image === 'default_image'){
                                        deviceimg.src = '/images/placeholder_phone_image.png';
                                    } else {
                                        deviceimg.src = singleresult.device_image;
                                        //deviceimg.src = '/storage/product_images/'+singleresult.product_image;
                                    }

                                    let devicename = document.createElement('p');
                                    devicename.classList.add('device-make-result-name');
                                    devicename.innerHTML = singleresult.product_name;

                                    let selecttoggle = document.createElement('img');
                                    selecttoggle.id = 'checkbox-device-'+singleresult.id;
                                    selecttoggle.src = '/images/front-end-icons/purple_circle.svg';
                                    selecttoggle.classList.add('select-make-result-device');
                                    selecttoggle.classList.add('mt-4');

                                    let infotext = document.createElement('p');
                                    infotext.classList.add('select-make-result');
                                    infotext.innerHTML = 'Select this model';

                                    singledeviceresult.onclick = function(){
                                        toggleSelectDevice(singleresult.id);
                                    }

                                    singledeviceresult.appendChild(deviceimg);
                                    singledeviceresult.appendChild(devicename);
                                    singledeviceresult.appendChild(selecttoggle);
                                    singledeviceresult.appendChild(infotext);

                                    devicemakeresults.appendChild(singledeviceresult);
                                }

                                // show see all and sell
                                document.getElementById('sell-this').classList.remove('hidden');
                                // hide loader
                                document.getElementById('selling-brand-results-loader').classList.add('invisible');
                            } else {
                                // show no results
                                document.getElementById('selling-brand-results-loader').classList.add('invisible');
                                document.getElementById('no-results-brand').classList.remove('hidden');
                            }

                        } else {}
                    },
                });
            }

            function toggleSelectDevice(id){
                let element = document.getElementById('checkbox-device-'+id);
                let devices = $('.select-make-result-device');

                if(!element.classList.contains('selected-device')){
                    devices.removeClass('selected-device');
                    for (let index = 0; index < devices.length; index++) {
                        devices[index].src = 'images/front-end-icons/purple_circle.svg';
                    }

                    element.src = '/images/front-end-icons/purple_tick_selected.svg';
                    element.classList.add('selected-device');                    
                } else {
                    element.src = 'images/front-end-icons/purple_circle.svg';
                    element.classList.remove('selected-device');

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#top").offset().top - 300
                    }, 500);

                    $('.device-brand').css('filter', 'opacity(1)');
                    $('.device-make-result').remove();
                    $('.device-brand').remove();

                    $('#device-makes').addClass('hidden');
                    $('#device-make-results-title').addClass('hidden');
                    $('#sell-this').addClass('hidden');
                }
                

                checkCanSell();
            }

            function checkCanSell(){
                let selected = $('.select-make-result-device.selected-device');
                let btn = document.getElementById('select-sell-this');
                if(selected.length === 1){
                    btn.classList.remove('btn-light');
                    btn.classList.remove('disabled');
                    btn.classList.add('btn-active');
                } else {
                    btn.classList.remove('btn-active');
                    btn.classList.add('btn-light');
                    btn.classList.add('disabled');
                }
            }


            function seeAll(){
                let category = null;
                let brand = null;
                let selected_category = $('.selected-category')[0];
                let selected_brand = $('.device-brand.selected')[0];

                let splitted_category = selected_category.id.split('-');
                category = splitted_category[1];

                let splitted_brand = selected_brand.id.split('-');
                brand = splitted_brand[1];

                window.location = '/sell/devices/'+category+'/'+brand;
            }

            function sellThis(){
                let selected = $('.select-make-result-device.selected-device');
                if(selected.length === 1){
                    // previous
                    // console.log(selected_category);
                    // console.log(selected_brand);
                    localStorage.setItem('preselectedSellCategory', selected_category);
                    localStorage.setItem('preselectedBrand', selected_brand);

                    let splitted = selected[0].id.split('-');
                    let id = splitted[2];
                    window.location = '/sell/sellitem/'+id;
                }
            }

        </script>
@endsection