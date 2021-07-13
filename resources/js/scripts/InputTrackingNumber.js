$(document).ready(function(){
    $('.input_tracking').each(function(){

        $(this).hide();
    
    });

});

$('.input_tracking_button').on('click', function(){

    var tradeinid = $(this).data('id');

    $('.input_tracking').each(function(){

        $(this).hide();

        if($(this).data('id') === tradeinid){
            $(this).show();
        }
    
    });

    $(this).hide();

});

$('.input_tracking_button_submit').on('click', function(){

    var c = confirm('Are you sure you want to change tracking reference of this tradein?');

    if(c){
        var tradeinid = $(this).data('id');
        var input_tracking = $('#input_tracking_' + tradeinid).val();
    
        $.ajax({
            url: "/portal/customer-care/order-management-input-tracking",
            type:"POST",
            data:{
                input_tracking:input_tracking,
                tradeinid:tradeinid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                location.reload();
            }
        });
    }

});