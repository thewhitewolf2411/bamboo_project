
window.addEventListener('load', function(){
    document.getElementById('input-name').disabled = true;
    document.getElementById('input-lastname').disabled = true;
    document.getElementById('delivery_address').disabled = true;
    document.getElementById('billing_address').disabled = true;
    document.getElementById('contact-number').disabled = true;

    document.getElementById('input-email').disabled = true;
    document.getElementById('input-password').disabled = true;

    document.getElementById('radio-checked-yes').disabled = true;
    document.getElementById('radio-checked-no').disabled = true;
    document.getElementById('update-sub-submit').disabled = true;

    if($('#radio-checked-yes').is(':checked')) { 

        $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
        $('#select-text-yes').text('Selected');
        $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
        $('#select-text-no').text('Select');

    }
    if($('#radio-checked-no').is(':checked')) { 

        $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
        $('#select-text-yes').text('Select');
        $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
        $('#select-text-no').text('Selected');

    }
})

function changename(){

    if(document.getElementById('input-name').disabled != false){
        document.getElementById('input-name').disabled = false;
        document.getElementById('input-lastname').disabled = false;
        document.getElementById('delivery_address').disabled = false;
        document.getElementById('billing_address').disabled = false;
        document.getElementById('contact-number').disabled = false;
        document.getElementById('radio-checked-yes').disabled = false;
        document.getElementById('radio-checked-no').disabled = false;
        document.getElementById('input-email').disabled = false;
        document.getElementById('input-password').disabled = false;
        document.getElementById('update-sub-submit').disabled = false;
    }else{
        document.getElementById('input-name').disabled = true;
        document.getElementById('input-lastname').disabled = true;
        document.getElementById('delivery_address').disabled = true;
        document.getElementById('billing_address').disabled = true;
        document.getElementById('contact-number').disabled = true;
        document.getElementById('radio-checked-yes').disabled = true;
        document.getElementById('radio-checked-no').disabled = true;
        document.getElementById('input-email').disabled = true;
        document.getElementById('input-password').disabled = true;
        document.getElementById('update-sub-submit').disabled = true;
    }


}
