$('input[type=radio][name=missing]').on('change', function(){

    var id = $(this).data('value');

    if(this.value === 'missing'){
        $('#missing_image_div_' + id).removeClass('hidden');
        $('#missing_image_' + id).prop('required', true);

        $('#question-one-next-button-'+id).prop('disabled', true);

        $('#missing_image_' + id).on('change', function(){
            if($(this).val()){
                $('#question-one-next-button-'+id).prop('disabled', false);
            }
            else{
                $('#question-one-next-button-'+id).prop('disabled', true);
            }
        });
    }
    else{
        $('#missing_image_div_' + id).addClass('hidden');
        $('#missing_image_' + id).prop('required', false);

        $('#question-one-next-button-'+id).prop('disabled', false);
    }
});

$('input[type=radio][name=visible_imei]').on('change', function(){

    var id = $(this).data('value');

    $('#question-two-next-button-'+id).prop('disabled', false);

});

$(document).ready(function(){

    $('.question-two').each(function(){
        $(this).hide();
    });

    $('.question-three').each(function(){
        $(this).hide();
    });

    $('.question-four').each(function(){
        $(this).hide();
    });

});

window.changeQuestion = function(question_number, current_question_number, tradein_id, result = null){

    if(question_number === 1 && current_question_number === 2){

        $('#question-two-'+tradein_id).hide();
        $('#question-one-'+tradein_id).show();

    }

    if(question_number === 2 && current_question_number === 1){

        if($('#missing-no-'+tradein_id).is(':checked')){
            $('.send-to-quarantine').show();
            $('.send-to-testing').hide();
            $('#question-one-'+tradein_id).hide();
            $('#result-page-'+tradein_id).show();
            $('#receiving-result-'+tradein_id).html('<p>Device is missing from package.</p><br>');
        }
        else{
            $('#question-one-'+tradein_id).hide();
            $('#question-two-'+tradein_id).show();
        }
    }

    if(question_number === 2 && current_question_number === 3){
        $('#question-three-'+tradein_id).hide();
        $('#question-two-'+tradein_id).show();
    }

    if(question_number === 3 && current_question_number === 2){

        if($('#visible_imei_no_'+tradein_id).is(':checked')){
            $('.send-to-quarantine').show();
            $('.send-to-testing').hide();
            $('#question-two-'+tradein_id).hide();
            $('#result-page-'+tradein_id).show();
            $('#receiving-result-'+tradein_id).html('<p>Device has no visible IMEI number.</p><br>');
        }
        else{
            $('#question-two-'+tradein_id).hide();
            $('#question-three-'+tradein_id).show();
        }

    }

    if(question_number === 4 && current_question_number === 3){

        $('#result-page-'+tradein_id).show();
        $('#question-three-'+tradein_id).hide();

        $('.send-to-quarantine').hide();

        if(result !== null && result.RawResponse.blackliststatus === 'No'){
            $('#receiving-result-'+tradein_id).html('<p>This device has passed receiving part of the testing.</p><br>');

            $('.send-to-quarantine').hide();
        }
        else if(result !== null){
            $('#receiving-result-'+tradein_id).html('<p>This device is blacklisted in ' + result.RawResponse.imeihistory[0].Country + '.</p><br>');

            $('.send-to-quarantine').each(function(){
                if($(this).data('id') === tradein_id){
                    $(this).show();
                }
                else{
                    $(this).hide();
                }
            });

            $('.send-to-testing').show();
        }
        
    }

    if(question_number === undefined && current_question_number === 4){

        if($('#missing-no-'+tradein_id).is(':checked')){
            $('#result-page-'+tradein_id).hide();
            $('#question-one-'+tradein_id).show();
        }
        else if($('#visible_imei_no_'+tradein_id).is(':checked')){
            $('#result-page-'+tradein_id).hide();
            $('#question-two-'+tradein_id).show();

        }
        else{
            $('#result-page-'+tradein_id).hide();
            $('#question-three-'+tradein_id).show();
        }

    }
    if(question_number === 3 && current_question_number === 4){

        $('#result-page-'+tradein_id).hide();
        $('#question-three-'+tradein_id).show();
    }

}

window.checkImeiNumber = function(tradein_id){

    var imeinumber = $('#imei_number_'+tradein_id).val();

    $.ajax({
        url: "/portal/testing/receive/checkimei",
        type:"POST",
        data:{
            "imei_number": imeinumber,
            "tradein_id": tradein_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            changeQuestion(4, 3, tradein_id, response);
        },
    });

}


$('.imei_number').on('input', function(e){

    var number = parseInt($(this).val());
    var numberLength = $(this).val().length;

    if(numberLength == 15){
        $('.imei_submit').each(function(){
            $(this).prop('disabled', false);
        });
    }
    else{
        $('.imei_submit').each(function(){
            $(this).prop('disabled', true);
        });
    }

});

$('.serial_number').on('input', function(e){

    var number = parseInt($(this).val());
    var numberLength = $(this).val().length;

    console.log(numberLength);

    if(numberLength >5){
        $('.serial_submit').each(function(){
            $(this).prop('disabled', false);
        });
    }
    else{
        $('.serial_submit').each(function(){
            $(this).prop('disabled', true);
        });
    }

});