<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/Customer.js') }}"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        
        <title>Bamboo Mobile::Wishlist</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="app">
                <div class="how-page how-title-container">
                    <div class="center-title-container">
                        <p>Wishlist</p>
                    </div>
                </div>

                <div class="profile-container">

                    <div class="col-8">
                        <div class="">
                            <div class="">
                                Mobile Phones
                            </div>
                            <div class="">
                            @if(count($mobilePhones) > 0)
                                @foreach($mobilePhones as $mobilePhone)
                                    {{$mobilePhone->product_name}}
                                @endforeach
                            @else
                            You haven’t saved any Mobile Phones to your wishlist yet. Start shopping and add your favourite items to your wishlist.
                            @endif
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                Tablets
                            </div>
                            <div class="">
                            @if(count($tablets) > 0)
                                @foreach($tablets as $tablet)
                                    {{$tablet->product_name}}
                                @endforeach
                            @else
                            You haven’t saved any Tablets to your wishlist yet. Start shopping and add your favourite items to your wishlist.
                            @endif
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                Watches
                            </div>
                            <div class="">
                            @if(count($smartwatches) > 0)
                                @foreach($smartwatches as $tablet)
                                    {{$tablet->product_name}}
                                @endforeach
                            @else
                            You haven’t saved any Watches to your wishlist yet. Start shopping and add your favourite items to your wishlist.
                            @endif
                            </div>
                        </div>
                        <div class="">
                            
                        </div>
                    </div>

                    <div class="col-4">
                    
                    </div>


                </div>

                <div class="shop-by-category">
                    <div class="shop-categories-container">
                        <a href="#">
                            <div class="category-container">
                                <p class="shop-title">Shop</p>
                                <p class="category-title">Mobile Phones</p>
                                <div class="rounded-background-image" id="rounded-mobile">
                                    <img src="{{asset('/shop_images/category-image-1.png')}}">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="category-container">
                                <p class="shop-title">Shop</p>
                                <p class="category-title">Tablets</p>
                                <div class="rounded-background-image" id="rounded-tablets">
                                    <img src="{{asset('/shop_images/category-image-2.png')}}">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="category-container">
                                <p class="shop-title">Shop</p>
                                <p class="category-title">Watches</p>
                                <div class="rounded-background-image" id="rounded-watches">
                                    <img src="{{asset('/shop_images/category-image-3.png')}}">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="category-container">
                                <p class="shop-title">Shop</p>
                                <p class="category-title">Accesories</p>
                                <div class="rounded-background-image" id="rounded-accesories">
                                    <img src="{{asset('/shop_images/category-image-4.png')}}">
                                </div>
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
            </div>
        </main>
        <footer>@include('customer.layouts.footer')</footer>
    </body>
</html>