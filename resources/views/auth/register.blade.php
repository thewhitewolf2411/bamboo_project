@if(Session::has('regerror'))
<div class="alert alert-danger" role="alert">
  {{@Session::get('regerror')}}
</div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" class="form-control" placeholder="John" name="first-name" required autofocus>
    </div>

    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" class="form-control" placeholder="Doe" name="last-name" required autofocus>
    </div>

    <div class="form-group">
        <label for="first-name">Email</label>
        <input type="email" class="form-control" placeholder="john.doe@example.com" name="email" required autofocus>
    </div>

    <div class="form-group">
        <label for="first-name">Birth date</label>
        @include('partial.birthdate')
    </div>

    <div class="form-group">
        <label for="delivery_address">Delivery Address</label>
        <input class="form-control js-typeahead" type="text" id="delivery_address" name="delivery_address" placeholder="Example delivery address" required autofocus>
    </div>

    <div class="form-group">
        <label for="billing_address">Billing Address</label>
        <input class="form-control js-typeahead" type="text" id="billing_address" name="billing_address" placeholder="Example billing address" required autofocus>
    </div>

    <div class="form-group">
        <label for="contact_number">Contact number</label>
        <input class="form-control" type="number" id="contact_number" name="contact_number" placeholder="Contact number" required autofocus>
    </div>

    <div class="form-group">
        <label for="contact_number">Password</label>
        <input type="password" id="psw" class="form-control" placeholder="Select password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autofocus>
        <div id="message">
            <p>Password must contain the following:</p>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
    </div>

    <div class="d-flex py-3">
        <input id="showpassword" type="checkbox" onclick="showPassword()" style="width:auto; margin:0;"><label id="showPasswordLabel" style="margin-left:1rem" for="showpassword">Show password</label>
    </div>

    <div class="form-group">
        <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone">
            <option value="" selected disabled>Your current phone</option>
            @foreach($products as $product)
            <option value="{{$product->id}}">{{$product->product_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <select class="selectpicker form-control" name="preferred-os">
            <option value="" selected disabled>Preferred Operating System (OS)</option>
            <option>iOS</option>
            <option>Android</option>
            <option>Other</option>
        </select>
    </div>

    <h3>Newsletter subscription</h3>

    <div class="newsletter-subscription">
        <label class="news-label">
            <input id="radio-checked-yes" type="radio" name="sub" value="true" required>

            <div class="news-label-content">
                <p><b>Yes,</b> I would love to hear about the latest amazing offers, hints & tips</p>
                <div class="news-label-selected-container">
                    <img id="select-image-yes" src="{{asset('/customer_page_images/body/Icon-Tick-Selected-clear.svg')}}" width="48px" height="48px">
                    <p id="select-text-yes">Select</p>
                </div>
            </div>

        </label>

          <label class="news-label">
            <input id="radio-checked-no" type="radio" name="sub" value="false" required>

            <div class="news-label-content">
                <p><b>No,</b>  I do not want to hear about the latest amazing offers, hints & tips</p>
                <div class="news-label-selected-container">
                    <img id="select-image-no" src="{{asset('/customer_page_images/body/Icon-Tick-Selected-clear.svg')}}" width="48px" height="48px">
                    <p id="select-text-no">Select</p>
                </div>
            </div>
          </label>
    </div>

    <div class="form-group mb-0 d-flex justify-content-between" style="padding: 50px 0 50px 0;">
        <div class="terms-container">
            <input type="checkbox" class="mx-3" id="terms" name="terms" required>
            <label for="terms">I agree to Bamboo Mobile <a href="/terms" target="_blank">Terms and Conditions</a></label>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</form>

<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}

    function showPassword(){
        var x = document.getElementById("psw");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script>

    $('input[type=radio][name=sub]').change(function() {
        if (this.value == 'true') {
            $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
            $('#select-text-yes').text('Selected');
            $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
            $('#select-text-no').text('Select');
        }
        else if (this.value == 'false') {
            $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
            $('#select-text-yes').text('Select');
            $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
            $('#select-text-no').text('Selected');
        }
    });

</script>

<script src="{{asset('/js/Addressian.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css">

