
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#reference').on('change', function(){

    if(this.value == 'a' || this.value == 'b+' || this.value == 'b' || this.value == 'c'){
        $('#network').prop('disabled', false);
        $('#network').prop('required', true);
    }
    else{
        $('#network').prop('disabled', true);
        $('#network').prop('required', false);
    }
});

$('.boxrow').on('click', function(){

    var boxname = $(this).attr('id');

    $('#adddeviceboxid').prop('value', boxname);
    
    if(!$(this).parent().parent().hasClass('boxrowhoverselected')){
        $('.boxrowhover').each(function(){
            $(this).removeClass('boxrowhoverselected');
        });

        $(this).parent().parent().toggleClass('boxrowhoverselected');

        $('#boxtabledevices').removeClass('boxtablehidden');
        $('#notopen').addClass('boxtablehidden');

        $.ajax({
            url: "/portal/warehouse-management/getdevices",
            type:"GET",
            data:{
                boxname:boxname,
            },
            success:function(response){
                $('.tabledevices').remove();
                $('#adddevicetradeinid').focus();
                for(var i = 0; i<response.length; i++){
                    $('#boxdevices').append('<tr class="tabledevices"><td><div class="table-element">' + boxname + '</div></td><td><div class="table-element">' + response[i].barcode + '</div></td><td><div class="table-element">' + response[i].bamboo_grade + '</div></td><td><div class="table-element">' + response[i].imei_number + '</div></td><td><div class="table-element">' + response[i].product_id + '</div></td><td><div class="table-element">' + response[i].model + '</div></td></tr>')
                }
            },
        });
    }
    else{
        $('.boxrowhover').each(function(){
            $(this).removeClass('boxrowhoverselected');
        });
        $('#boxtabledevices').addClass('boxtablehidden');
        $('#notopen').addClass('boxtablehidden');
    }

});

$('.boxrownotopen').on('click', function(){
    var boxname = $(this).attr('id');

    $('#adddeviceboxid').prop('value', boxname);
    
    if(!$(this).parent().parent().hasClass('boxrowhoverselected')){
        $('.boxrowhover').each(function(){
            $(this).removeClass('boxrowhoverselected');
        });

        $(this).parent().parent().toggleClass('boxrowhoverselected');

        $('#boxtabledevices').addClass('boxtablehidden');
        $('#notopen').removeClass('boxtablehidden');

        $.ajax({
            url: "/portal/warehouse-management/getdevices",
            type:"GET",
            data:{
                boxname:boxname,
            },
            success:function(response){
                $('.tabledevices').remove();
                $('#viewboxid').prop('value', '');
                $('#viewboxid').prop('value', boxname);
                for(var i = 0; i<response.length; i++){
                    $('#notopenboxdevices').append('<tr class="tabledevices"><td><div class="table-element">' + boxname + '</div></td><td><div class="table-element">' + response[i].barcode + '</div></td><td><div class="table-element">' + response[i].bamboo_grade + '</div></td><td><div class="table-element">' + response[i].imei_number + '</div></td><td><div class="table-element">' + response[i].product_id + '</div></td><td><div class="table-element">' + response[i].model + '</div></td></tr>')
                }
            },
        });
    }
    else{
        $('.boxrowhover').each(function(){
            $(this).removeClass('boxrowhoverselected');
        });
        $('#boxtabledevices').addClass('boxtablehidden');
        $('#notopen').addClass('boxtablehidden');
    }
})

$('.openbox').on('click', function(){


    var boxname = $(this).attr('id');

    var c = confirm("Are you sure you want to open box " + boxname + "?");

    if(c){
        $.ajax({
            url: "/portal/warehouse-management/box-management/openbox",
            type:"POST",
            data:{
                boxname:boxname,
            },
            success:function(response){
                location.reload();
            },
        });
    }


});

$('#suspend-box').on('click', function(){
    var boxid = $(this).attr('data-value');

    var c = confirm("Are you sure you want to suspend box " + boxid + "?");

    if(c){
        $.ajax({
            url: "/portal/warehouse-management/box-management/suspendbox",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                boxid:boxid,
            },
            success:function(response){
                location.href = '/portal/warehouse-management/box-management/';
            },
        });
    }

});

$('#complete-box').on('click', function(){
    var boxid = $(this).attr('data-value');

    var c = confirm("Are you sure you want to close the box " + boxid + "?");

    if(c){

        $.ajax({
            url: "/portal/warehouse-management/box-management/completebox",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                boxid:boxid,
            },
            success:function(response){
                location.href = '/portal/warehouse-management/box-management/';
            },
        });
    }


});

$(document).ready(function(){

    if(document.getElementsByClassName('completebox').length>0){
        $('.completebox').hide();
        $('#showboxed').css('opacity', 0.65);
    }

});

$('#showinprogress').on('click', function(){
    $('.completebox').hide();
    $('.uncompletebox').show();

    $('#showboxed').css('opacity', 0.65);
    $('#showinprogress').css('opacity', 1);
});

$('#showboxed').on('click', function(){
    $('.completebox').show();
    $('.uncompletebox').hide();
    $('#showboxed').css('opacity', 1);
    $('#showinprogress').css('opacity', 0.65);
})

$('#adddevicetradeinid').on('input', function(){

    var boxname = $('#adddeviceboxid').attr('value');
    var tradeinid = $('#adddevicetradeinid').val();

    $.ajax({
        url: "/portal/warehouse-management/box-management/checkboxstatusfordevice",
        type:"POST",
        data:{
            boxname:boxname,
            tradeinid:tradeinid,
        },
        success:function(data, textStatus, xhr){
            $('.appendedalert').remove();
            $('#adddevicebtn').prop('disabled', false);
            $('#alerts').append('<div class="appendedalert alert alert-success" role="alert">' + data + '</div>');
            
        },
        error:function(data, textStatus, xhr){
            $('.appendedalert').remove();
            $('#adddevicebtn').prop('disabled', true);
            $('#alerts').append('<div class="appendedalert alert alert-danger" role="alert">' + data.responseText + '</div>');
        },
    });

});

$('.printboxlabel').on('click', function(){
    var boxname = $(this).attr('data-value');

    $.ajax({
        url: "/portal/warehouse-management/box-management/printboxlabel",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            boxname:boxname,
        },
        success:function(data, textStatus, xhr){
            window.open(data);
        },
        error:function(data, textStatus, xhr){
            alert('Something went wrong. Please try again.');
        },
    });
});

$('.printboxmanifest').on('click', function(){
    var boxname = $(this).attr('data-value');

    $.ajax({
        url: "/portal/warehouse-management/box-management/printboxmanifest",
        type:"POST",
        data:{
            boxname:boxname,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data, textStatus, xhr){
            window.open(data);
        },
        error:function(data, textStatus, xhr){
            alert('Something went wrong. Please try again.');
        },
    });
});

$('.printboxsummary').on('click', function(){
    var boxname = $(this).attr('data-value');

    $.ajax({
        url: "/portal/warehouse-management/box-management/printboxsummary",
        type:"POST",
        data:{
            boxname:boxname,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data, textStatus, xhr){
            window.open(data);
        },
        error:function(data, textStatus, xhr){
            alert('Something went wrong. Please try again.');
        },
    });
});
