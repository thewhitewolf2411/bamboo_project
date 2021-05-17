if(document.getElementById('password_reg')){
    document.getElementById("password_reg").addEventListener('keyup',  function(){
        checkNewPass("password_reg");
    });
}

if(document.getElementById('password_card')){
    document.getElementById("password_card").addEventListener('keyup',  function(){
        checkNewPass("password_card");
    });
}


window.checkNewPass = function(select){
    let pass = document.getElementById(select).value;

    let select2 = null;

    if(select == "password_card"){
        select2 = "pass-check-info-card";
    }
    else{
        select2 = "pass-check-info";
    }
    
    var passcheck = document.getElementById(select2);

    pass = pass.trim();

    if(pass !== ""){
        // show pass info
        if(passcheck.classList.contains("hidden")){
            passcheck.classList.remove("hidden");
        }
        // analyze pass

        let has_number = false;
        let has_symbol = false;
        let has_uppercase_letter = false;
        let has_ten_characters = false;
        
        // check length
        if(pass.length < 8){
            has_ten_characters = false;
        } else {
            has_ten_characters = true;
        }

        // check if it has a number
        let has_number_check = pass.match(/\d+/g);
        if(Array.isArray(has_number_check)){
            has_number = true;
        } else {
            has_number = false;
        }

        // check for symbols
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        has_symbol = format.test(pass);

        // check for uppercase
        let countUpperCase = 0;
        let i = 0;
        while (i <= pass.length) {
            const character = pass.charAt(i);
            if (character === character.toUpperCase() && character !== character.toLowerCase()) {
                countUpperCase++;
            }
            i++;
        }
        if(countUpperCase > 0){
            has_uppercase_letter = true;
        }

        // bar percentage
        let percentage = '10%';

        if(has_ten_characters){
            percentage = '25%';
        }
        if(has_number){
            percentage = '50%';
        }
        if(has_symbol){
            percentage = '75%';
        }
        if(has_uppercase_letter){
            percentage = '100%';
        }

        let passqualityobj = {
            has_ten_characters: has_ten_characters,
            has_number: has_number,
            has_symbol: has_symbol,
            has_uppercase_letter: has_uppercase_letter
        };

        let pass_quality = 0;
        for (const [key, value] of Object.entries(passqualityobj)) {
            if(value === true){
                pass_quality++;
            }
        }

        percentage = Math.round(pass_quality * 2.5) + "0%";

        // set bar percentage
        //document.getElementById("bar").style.width = percentage;

        if(select == "password_card"){
            document.getElementById("bar-card").style.width = percentage;
        }
        else{
            document.getElementById("bar").style.width = percentage;
        }

        // pass text strength
        if(has_ten_characters && has_number && has_symbol && has_uppercase_letter){
            if(select == "password_card"){
                document.getElementById("pass-strength-card").innerHTML = 'Fair';
            }
            else{
                document.getElementById("pass-strength").innerHTML = 'Fair';
            }

            // if(current.value && email.value){
            //     if(save_btn.classList.contains('btn-secondary')){
            //         save_btn.classList.remove('btn-secondary');
            //         if(!save_btn.classList.contains('btn-orange')){
            //             save_btn.classList.add('btn-orange');
            //         }
            //     }
            //     if(save_btn.classList.contains('disabled')){
            //         save_btn.classList.remove('disabled');
            //     }
            // }
        } else {

            // if(!save_btn.classList.contains('btn-secondary')){
            //     save_btn.classList.add('btn-secondary');
            //     if(save_btn.classList.contains('btn-orange')){
            //         save_btn.classList.remove('btn-orange');
            //     }
            // }
            // if(!save_btn.classList.contains('disabled')){
            //     save_btn.classList.add('disabled');
            // }

            if(select == "password_card"){
                document.getElementById("pass-strength-card").innerHTML = 'Unsecure';
            }
            else{
                document.getElementById("pass-strength").innerHTML = 'Unsecure';
            }
        }

        

    } else {
        if(!passcheck.classList.contains("hidden")){
            passcheck.classList.add("hidden");
        }
    }
}

window.togglePassVisibility = function(){
    var img = document.getElementById('pass-visibility-toggle-reg');
    var pass = document.getElementById('password_reg');
    
    if (pass.type === "password") {
        pass.type = "text";
        img.src = '/images/front-end-icons/pass_visible.svg';
        img.style.right = '7px';
    } else {
        img.src = '/images/front-end-icons/pass_invisible.svg';
        pass.type = "password";
        img.style.right = '5px';
    }
}

window.togglePassCardVisibility = function(){
    var img = document.getElementById('pass-visibility-toggle');
    var pass = document.getElementById('password_card');
    
    if (pass.type === "password") {
        pass.type = "text";
        img.src = '/images/front-end-icons/pass_visible.svg';
        img.style.right = '7px';
    } else {
        img.src = '/images/front-end-icons/pass_invisible.svg';
        pass.type = "password";
        img.style.right = '5px';
    }
}

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

$(document).ready(function(){

    //alert(location.hash);

    if(location.hash === '#CustomerDeviceNotAvaliable'){
        showContactForm('message');

        $([document.documentElement, document.body]).animate({
            scrollTop: $("#message-form-container").offset().top
        }, 1000);

        $('#title').val('Customer device not available');
    }

    let preselected = '{!!$selected!!}';
    if(preselected){
        switch (preselected) {
            case "message":
                document.getElementById("contact-message").click();
                break;
            case "call":
                document.getElementById("contact-telephone").click();
                break;
            default:
                break;
        }
    }
});


window.showContactForm = function(contact){

    let contactbuttons = document.getElementsByClassName('ways-container')[0].getElementsByClassName('ways-element');
    let contactforms = document.getElementsByClassName('contact-form-container');
    for(var i = 0; i<contactbuttons.length; i++){
        contactbuttons[i].classList.add('contact-div-hidden');
    }

    for(var j = 0; j < contactforms.length; j++){
        contactforms[j].classList.remove('contact-form-container-active');
    }

    switch(contact){
        case "message":
        contactbuttons[0].classList.remove('contact-div-hidden');
        contactforms[0].classList.add('contact-form-container-active');
        break;
        //case "live":
        //contactbuttons[1].classList.remove('contact-div-hidden');
        //contactforms[1].classList.add('contact-form-container-active');
        break;
        case "telephone":
        contactbuttons[1].classList.remove('contact-div-hidden');
        contactforms[2].classList.add('contact-form-container-active');
        break;
        //case "whatsapp":
        //contactbuttons[3].classList.remove('contact-div-hidden');
        //contactforms[3].classList.add('contact-form-container-active');
        break;
    }

}