function addNewMemoryPoint(){
    if(!$('#newMemoryRow').hasClass('newMemoryRowActive')){
        $('#newMemoryRow').addClass('newMemoryRowActive');
        $('#newMemoryRow :input').prop('required', true);
        $('#newMemoryRowButton').addClass('newMemoryRowButtonDisable')
    }
}

function cancelNewMemoryPoint(){
    if($('#newMemoryRow').hasClass('newMemoryRowActive')){
        $('#newMemoryRow').removeClass('newMemoryRowActive');
        $('#newMemoryRow :input').prop('required', false);
        $('#newMemoryRowButton').removeClass('newMemoryRowButtonDisable');
    }
}

$(document).ready(function(){

    $('#add_new_network_container').hide();
    $('#add_new_network_price_container').hide();

});


function addNewNetwork(){
    if($('#add_new_network_container').is(':hidden')){
        $('#add_new_network_container').show();
        $('#add_new_network_price_container').show();

        $('#add_new_network_id').prop('required', true);
        $('#add_new_network_knockoffprice').prop('required', true);
    }
    else{
        $('#add_new_network_container').hide();
        $('#add_new_network_price_container').hide();

        $('#add_new_network_id').prop('required', false);
        $('#add_new_network_knockoffprice').prop('required', false);
    }
}