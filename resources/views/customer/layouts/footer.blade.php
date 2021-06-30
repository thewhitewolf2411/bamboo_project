<div class="footer">

    <div class="footer-row" id="footer-row-1">

        @if($showGetstarted)
            <div class="footer-row-2 start-selling-section-footer">
                <span>Get Started</span>
                    {{-- <div class="url-footer-container" id="start-shopping">
                        <a href="/shop">Start Shopping</a>
                    </div> --}}
                    <a href="/sell" class="btn start-selling footer"><p>Start Selling</p></a>
            </div>
        @endif

        <div class="footer-row-2">
            <span>Follow our adventures</span>
            <div class="footer-social-icons-container">
                <a href="http://www.facebook.com/BambooMobileTech/" target="_blank">
                    {{-- <i class="fa fa-facebook" aria-hidden="true"></i> --}}
                    <img src="{{asset('/images/front-end-icons/social-facebook.svg')}}">
                </a>
                {{--<a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>--}}
                <a href="http://www.instagram.com/mobileswithboo/" target="_blank">
                    {{-- <i class="fa fa-instagram" aria-hidden="true"></i> --}}
                    <img src="{{asset('/images/front-end-icons/social-instagram.svg')}}">
                </a>
                <a href="http://www.youtube.com/channel/UCePgdCF8oCRXenvvLADp38w/featured" target="_blank">
                    {{-- <i class="fa fa-youtube" aria-hidden="true"></i> --}}
                    <img src="{{asset('/images/front-end-icons/social-youtube.svg')}}">
                </a>
            </div>
        </div>


    </div>

    <div class="footer-line"></div>


    <div class="footer-row" id="footer-row-2">
        <div class="footer-row-6">
            <span>ABOUT US</span>
            <a href="/about">About Bamboo</a>
        </div>
        <div class="footer-row-6">
            <span>HOW IT WORKS</span>
            {{-- <a href="/setpage/how">Shopping</a> --}}
            @if(isset($sellingurl) && $sellingurl)
            <a href="/sell">Selling</a>
            @else
            <a href="/how">Selling</a>
            @endif
        </div>
        <div class="footer-row-6">
            {{-- <span>SERVICE & SUPPORT</span> --}}
            <span>Frequently asked questions</span>
            {{-- <a href="/setpage/support">Buying a device</a> --}}
            <a href="/support">Selling a device</a>
            <a href="/support">Tech</a>
            <a href="/support">Delivery</a>
            <a href="/support">Your Order</a>
            <a href="/support">Your Account</a>
            <a href="/support">General Questions</a>
        </div>
        {{-- <div class="footer-row-6">
            <span>RESPONSIBILITIES</span>
            <a href="/environment">Environment</a>
            <a href="/charity">Charity Partners</a>
        </div> --}}
        <div class="footer-row-6">
            <span>NEWS & BLOG</span>
            <a href="/news">News</a>
            <a href="/news">Blog</a>
        </div>
        <div class="footer-row-6">
            <span>LEGAL</span>
            <a href="/privacy">Privacy Policy</a>
            <a href="/terms">Terms & Conditions</a>
            <a href="/map">Site map</a>
            <a href="/cookies">Cookies</a>
            <a href="/slavery">Modern Slavery</a>
            {{--<a href="/recyclepolicy">Recycle Policy</a>--}}
            <a href="https://www.bamboodistribution.com/" target="_blank">Corporate Site</a>
        </div>
        <div class="footer-row-6">
            <span>Contact Us</span>
            <a href="/contact/message">Message Us</a>
            <a href="/contact/call">Call Us</a>
        </div>
    </div>

    <div class="footer-row" id="footer-row-3">
        <div class="footer-row-2 copyright-container">
            <p class="copyright">©Bamboo {!!\Carbon\Carbon::now()->year!!}. All rights reserved</p>
        </div>
        <div class="row m-0 return-top-container">
            <a class="mr-0 ml-auto cursor-pointer" onclick="window.scrollTo({top: 0, behavior: 'smooth'});"><p class="return-top-button bebas-neue" style="color: white;">RETURN TO TOP</p> <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
    </div>


</div>