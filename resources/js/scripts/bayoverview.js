$('.baydelete').on('click', function(){
    var bayname = $(this).attr('id');

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/deletebay",
        type:"POST",
        data:{
            bayname:bayname,
        },
        success:function(response){
            location.reload();
        },
    });
});

$('.bayprint').on('click', function(){
    var bayname = $(this).attr('id');

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/printbay",
        type:"POST",
        data:{
            bayname:bayname,
        },
        success:function(data, textStatus, xhr){
            window.open(data);
        },
        error:function(data, textStatus, xhr){
            alert('Something went wrong. Please try again.');
        },
    });
});

$('#checkboxsubmit').on('click', function(){

    var bayname = $('#bayid').val();
    var boxname = $('#inputboxid').val();

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/bay/checkallocatebox",
        type:"POST",
        data:{
            bayname:bayname,
            boxname:boxname,
        },
        success:function(response){
            if($('#addedboxestable tr').length > 1){
                if($('#' + response[0]).length == 0 ){
                    $('#addedboxestable').append('<tr id="' + response[0] + '"><td><div class="table-element">' + response[0] + '</div></td><td><div class="table-element">' + response[1] + '</div></td></tr>');
                    $('#form-inputs').append('<input type="hidden" name="box-'+ response[0] + '" value="'+ response[0] +'">');
                }
                else{
                    $('#statement').html('<div class="alert alert-warning"> This box was already added. </div>');
                }
                
            }
            else{
                    $('#addedboxestable').append('<tr id="' + response[0] + '"><td><div class="table-element">' + response[0] + '</div></td><td><div class="table-element">' + response[1] + '</div></td></tr>');
                    $('#form-inputs').append('<input type="hidden" name="box-'+ response[0] + '" value="'+ response[0] +'">');
                }
        },
        error:function(data, textStatus, xhr){
            $('#statement').html('<div class="alert alert-warning">' + data.responseText + '</div>');
        },
    });


});
