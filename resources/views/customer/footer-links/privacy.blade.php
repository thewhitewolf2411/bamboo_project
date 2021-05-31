<!DOCTYPE html>
<html>

    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KC33JWC');</script>
        <!-- End Google Tag Manager -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Bamboo Mobile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="app">

                <div class="page-header-container privacypolicy">
                    <p class="page-header-text">Privacy Policy</p>
                </div>

                @if(Session::get('_previous') !== null)
                    <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
                @else
                    <a class="back-to-home-footer mt-3" href="/">
                @endif
                    <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
                </a>

                <div class="container footer-legal">

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">Data Protection</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p class="footer-text-small">
                            Bamboo Distribution Ltd (Bamboo) is a privately owned Limited Company. This Privacy Policy describes our practices related to Personal Information and how Bamboo applies the principles and rights afforded to individuals by the General Data Protection Regulation (GDPR). <br>
                            As a business, we need to process information about our customers to monitor our performance and achievements, to facilitate deliveries, collections and payments, administrate accounts and keep customers informed of our activities. <br>
                            Because of our commitment to the principles of GDPR, we will willingly give you access to any personal information we have about you. We aim to comply with requests to access personal information as quickly as possible so you can request your information be amended, erased, or not used for marketing purposes.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">Legal Basis for Collecting and Processing your Personal Information </p>
                        </div>
                        <p class="footer-text-small">
                            The law on data protection sets out several different grounds on which we can collect and process your personal information. The information below sets out when we rely on these different grounds:
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Contractual Obligations</p>
                        </div>
                        <p class="footer-text-small">
                            When we enter into a contract with you, we need your personal data to be able to fulfil the contract. E.g. We will need your address to be able to deliver the item to you. We may also need your contact details such as email address to confirm the order to you.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Legal Compliance</p>
                        </div>
                        <p class="footer-text-small">
                            We may be required by law to retain some of your personal data e.g. fraud prevention. 
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Legitimate interest</p>
                        </div>
                        <p class="footer-text-small">
                            We may use your personal data for our legitimate interests e.g. keeping details of your purchase history so that we can provide you with a personalised service.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Consent</p>
                        </div>
                        <p class="footer-text-small">
                            Where you have given us your consent e.g. where you have ticked a box to say you would like to hear from us.<br>

                            Your rights over the way in which we use your data will vary depending on which ground we are relying upon. Please see the Withdrawing consent and Your rights sections.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Our Privacy Promise</p>
                        </div>
                        <p class="footer-text-small">
                            We promise:
                        </p>
                        <ul class="footer-text-small">
                            <li>To keep your data safe and private</li>
                            <li>Not to sell your data</li>
                            <li>Not to share your data, except where we have a legitimate business interest to do so. A legitimate interest is when we have a business reason to use your information, but even then, it must not unfairly go against what is right and best for you.</li>
                        </ul>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">How the law protects you</p>
                        </div>
                        <p class="footer-text-small">
                            As well as our Privacy Promise, your privacy is protected by law, which says that we are allowed to use personal information only if we have a proper reason to do so. The law says that we must have one or more of these reasons: 
                        </p>
                        <ul class="footer-text-small">
                            <li>To fulfil a contract we have with you, or </li>
                            <li>When it is our legal duty, or </li>
                            <li>When it is in our legitimate interest, or </li>
                            <li>When you consent to it. </li>
                        </ul>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Information Collected</p>
                        </div>
                        <p class="footer-text-small">
                            Here’s a list of information that Bamboo collects from you when opening an Account. This enables Bamboo to fulfil its contractual obligations with you as a customer: 
                        </p>
                        <ul class="footer-text-small">
                            <li>Contact Name(s)</li>
                            <li>Contact Telephone Number</li>
                            <li>Contact e-mail address </li>
                            <li>Date of Birth</li>
                            <li>Home Address</li>
                            <li>Delivery Address</li>
                            <li>Payment information </li>
                            <li>Contact History</li>
                            <li>Your purchase history and saved items</li>
                        </ul>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Information about your devices and how you use our services</p>
                        </div>
                        <p class="footer-text-small">
                            When you visit our site or send an email to us, we will automatically collect information about the device you’re using (i.e. mobile, computer, tablet, etc) as well as your operating system, access times, browser information (including type, language and history), your location data, settings and other data required to deliver the services described in this policy.<br><br>
                            We use cookies and other technologies to collect this information and use it in the following ways:
                        </p>
                        <ul class="footer-text-small">
                            <li>Provide you with a personalised browsing experience, including recommend products and services.</li>
                            <li>Deliver Bamboo adverts to you across the web.</li>
                            <li>Research and data analysis. </li>
                            <li>Developing new products and services.</li>
                        </ul>

                        <p class="footer-text-small">
                            We apply all the safeguards outlined in this policy when combining your personal information with your device information.<br>
                            In some instances, we may provide third parties with aggregated information and analytics in order to deliver and improve our service. This information will be anonymised so it cannot be used to identify you.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">Why does Bamboo collect such Information? </p>
                        </div>
                        <p class="footer-text-small">
                            Bamboo collects this information is to enable Bamboo to fulfil our contractual obligations with you and enable Bamboo to provide customised services and products relevant to your specific needs:
                        </p>
                        <ul class="footer-text-small">
                            <li>Delivering items you’ve purchased.</li>
                            <li>Sending important service-related messages by text, email, post and push notifications (you can opt out of any of these at any time in your account settings).</li>
                            <li>Sending information about our latest offers, discounts, voucher codes, competitions and updates by text, email, post, social media and push notifications (again, you can opt out of any of these at any time in your account settings).</li>
                            <li>Fraud prevention and detection.</li>
                            <li>To determine which products, offers and services will be of interest to you, plus send you birthday treats like voucher codes.</li>
                            <li>Take payment for the products you’ve purchased.</li>
                        </ul>

                        <p class="footer-text-small">
                            <u>Please Noted: We do not store your credit or debit card details and ensure that any bank details that we need to hold are held subject to all appropriate security measures.</u><br>
                        </p>

                        <ul class="footer-text-small">
                            <li>Provide customer service and support.</li>
                            <li>Devise solutions to common customer problems</li>
                            <li>Train our customer service team</li>
                            <li>Provide a personalised experience when using our website (including recommended products) using automated and computerised technology.</li>
                            <li>Review, develop and improve the products and services we offer</li>
                            <li>Send marketing emails relevant to your interests</li>
                        </ul>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small title-blue">
                            <p class="text-left footer-text-title">How does Bamboo use such Information?</p>
                        </div>
                        <p class="footer-text-small">
                            Your information may be used by Bamboo to carry out our contractual obligations, or authenticate you as a customer and may be used to:
                        </p>
                        <ul class="footer-text-small">
                            <li>Provide requested information, products, or services;</li>
                            <li>Advertise products, services, promotions and events relating to the Company;</li>
                            <li>Improve our products and services, </li>
                            <li>Protect against fraud or investigate suspected or actual illegal activity; </li>
                            <li>Respond to a legitimate legal request from law enforcement authorities or other government regulators;  </li>
                            <li>Conduct investigations to ensure compliance with, and comply with, legal obligations.  </li>
                        </ul>

                        <p class="footer-text-small">
                            Except where used in support of a contract with you or to fulfil a legal obligation, our use of your Personal Information will be only for legitimate business interests as set out above.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">How does Bamboo secure Personal Information?</p>
                        </div>
                        <p class="footer-text-small">
                            Bamboo is committed to ensuring the security and integrity of Personal Information. Bamboo has adopted reasonable physical, electronic and managerial procedures to safeguard your Personal Information. However, due to the nature of Internet communications, we cannot guarantee or warrant that your transmission to us is secure. <br><br>
                            Does Bamboo share the information it collects? <br><br>
                            Bamboo will not sell your Personal Information. <br>
                            Bamboo will only share your Personal Information outside of our Company, as a legitimate business interest to fulfil our contractual obligations. <br>
                            The following is a list of legitimate business interests whereby Bamboo may share some, or all of your personal information with a third-party organisation:
                        </p>
                        <ul class="footer-text-small">
                            <li>Service providers, dealers, distributors, agents or contractors that Bamboo has retained to perform services on our behalf. </li>
                            <li>Bamboo will only share your Personal Information with third parties whom Bamboo has contractually restricted from using or disclosing the information except as necessary to perform services on our behalf, or to comply with legal requirements; </li>
                            <li>Comply with legal obligations, such as in response to a legitimate legal request from law enforcement authorities, courts or other government regulators or authorities, among other things;  </li>
                            <ul>
                                <li>Investigate suspected or actual illegal activity; </li>
                                <li>Prevent physical harm or financial loss; or</li>
                                <li>Support the sale or transfer of all or a portion of our business or assets (including through bankruptcy) </li>
                            </ul>
                        </ul>

                        <p class="footer-text-small">
                            Except where used in support of a contract with you or to fulfil a legal obligation, our use of your Personal Information will be only for legitimate business interests as set out above.
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">How can you correct, change or delete your information held by Bamboo?</p>
                        </div>
                        <p class="footer-text-small">
                            You may request to access, update, correct, change, or delete your Personal Information at any time. Bamboo will use reasonable efforts to timely update and/or remove information. To protect the user’s privacy and security, Bamboo will take steps to verify the user’s identity before making any requested change. To access, change, or delete your Personal. Information, to report problems with the Website, to ask questions or to raise concerns, please send an email to info@bamboodistribution.com <br>
                            Please note that while we will assist you in protecting your Personal Information, it is your responsibility to protect your passwords and other access credentials from others. <br><br>
                            How long do we keep your Personal Information? <br><br>
                            The Personal Information you provide to Bamboo is only kept for as long as it is reasonably necessary for the purposes for which it was collected, taking into account our need to comply with contractual obligations, resolve customer service issues, comply with legal requirements and provide new or improved services to users. This means that we may retain your Personal Information for a reasonable period after you stopped using Bamboo. <br>
                            After this period, your Personal Information will be deleted from all systems of Bamboo. without notice. 
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">How might Bamboo change this Privacy Policy?</p>
                        </div>
                        <p class="footer-text-small">
                            As Bamboo expands and improves its products and services, we may need to update this Privacy Policy. This Privacy Policy may be modified from time to time without prior notice. We encourage you to review this Privacy Policy on a regular basis for any changes. Substantive changes will be identified at the top of the Privacy Policy. 
                        </p>
                    </div>
                    <br>
                    <hr>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">How can you contact Bamboo?</p>
                        </div>
                        <p class="footer-text-small">
                            If you have any comments or questions about this Privacy Policy, or on the manner in which we treat your personal information, please e-mail info@bamboodistribution.com
                        </p>
                    </div>
                    <br>

                    {{-- <div class="col-md-12">

                        <p>Paula Hansson</p>
                        <p>Company Security</p>

                    </div> --}}

                </div>

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
        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>

        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

        </script>

    </body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KC33JWC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>