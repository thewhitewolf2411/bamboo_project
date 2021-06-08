const { isInteger } = require("lodash");

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


window.changeQuestion = function(question_number, current_question_number, tradein_id){

    if(question_number === 1 && current_question_number === 2){

        $('#question-two-'+tradein_id).hide();
        $('#question-one-'+tradein_id).show();

    }

    if(question_number === 2 && current_question_number === 1){

        if($('#missing-no-'+tradein_id).is(':checked')){
            $('#question-one-'+tradein_id).hide();
            $('#result-page-'+tradein_id).show();
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
            $('#question-two-'+tradein_id).hide();
            $('#result-page-'+tradein_id).show();
        }
        else{
            $('#question-two-'+tradein_id).hide();
            $('#question-three-'+tradein_id).show();
        }

    }

    if(current_question_number === 4){

        if($('#missing-no-'+tradein_id).is(':checked')){
            $('#result-page-'+tradein_id).hide();
            $('#question-one-'+tradein_id).show();
        }
        else if($('#visible_imei_no_'+tradein_id).is(':checked')){
            $('#result-page-'+tradein_id).hide();
            $('#question-two-'+tradein_id).show();
        }

    }

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