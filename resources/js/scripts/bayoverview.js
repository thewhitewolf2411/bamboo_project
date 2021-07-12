$('.baydelete').on('click', function(){

    var bayname = $(this).attr('id');

    var c = confirm("Do you want to delete bay " + bayname + "?");

    if(c){
        $.ajax({
            url: "/portal/warehouse-management/bay-overview/deletebay",
            type:"POST",
            data:{
                bayname:bayname,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                location.reload();
            },
        });
    }

});

$('#inputboxid').scannerDetection({
	   
    //https://github.com/kabachello/jQuery-Scanner-Detection
    
    timeBeforeScanTest: 200, // wait for the next character for upto 200ms
    avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
    preventDefault: true,

    endChar: [13],
    onComplete: function(barcode, qty){
        //validScan = true;
        //$('#search_id').val (barcode);
    }, // main callback function	,
    onError: function(string, qty) {
        $('#inputboxid').val (string);
        $('#checkboxsubmit').click();
        // console.log(string);
        // console.log(qty);
        //$('#userInput').val ($('#userInput').val()  + string);
    }
         
         
});


$('#checkboxsubmit').on('click', function(){

    var bayname = $('#bayid').val();
    var boxname = $('#inputboxid').val();

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/bay/checkallocatebox",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            bayname:bayname,
            boxname:boxname,
        },
        success:function(response){
            if($('#addedboxestable tr').length > 1){
                if(document.getElementById(response[0]) === null ){
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
            $('#inputboxid').val('');
        },
        error:function(data, textStatus, xhr){
            $('#statement').html('<div class="alert alert-warning">' + data.responseText + '</div>');
        },
    });


});

$('#allocateboxtobaymodal').on('hide.bs.modal', function(){

    if($('#addedboxestable tr').length > 1){
        $('#addedboxestable tr').each(function(){
            if($(this).attr('id') != null){
                $(this).remove();
            }
        });
    }

});