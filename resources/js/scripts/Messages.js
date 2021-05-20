$('.message').on('click', function(){

    var messageid = $(this).data('value');

    $.ajax({
        url: "/portal/customer-care/seemessage",
        type:"GET",
        data:{
            messageid:messageid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            //console.log(response.from_name, response.from_email, response.message);

            $('#message-from-name p').html(response.from_name);
            $('#message-from-email p').html(response.from_email);
            $('#message-content p').html(response.message);
            $('#reply-btn').prop('href', 'mailto:' + response.from_email);

            $('#messageModal').modal('show');
        }
    });


});

$('#messageModal').on('hidden.bs.modal', function () {
    location.reload();
});


//sending message

$(document).ready(function(){

    if(document.getElementById('title')){
        $('#custom-title-container').hide();
    }
    
    $('#title').change(function(){
    
        if($(this).val() === 'other'){
            $('#custom-title-container').show();
        }
        else{
            $('#custom-title-container').hide();
        }
    
    })

});

