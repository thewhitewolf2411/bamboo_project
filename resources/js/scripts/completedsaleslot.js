$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.saleslots').on('click', function(){

    $('.saleslots').each(function(){

        $(this).removeClass('saleslot-active');

    });

    $(this).addClass('saleslot-active');

    $('#saleslot-option-buttons button').prop('disabled', false);

});


$(document).on('change', '#changestate', function(){

    if($('#changestate').val() === '2'){
        $('#changestatesubmit').remove();
        $('#changelotstatedata').append('<div id="customer-name-input" class="form-group"><input type="text" name="customername" placeholder="Enter customer name"></div><div id="changestatesubmit"><input type="submit" class="btn btn-primary btn-blue" value="Change state"></div>');
    }
    else{
        $('#customer-name-input').remove();
    }

});
