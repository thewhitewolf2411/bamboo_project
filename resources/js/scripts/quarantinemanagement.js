
/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});*/

$('#manifacturer').on('change', function(){

    var options;
    switch($(this).val()){
        case "1":
            options = {
                '':'',
                'a':'(A) AP',
                'b+':'(B+) AP',
                'b':'(B) AP',
                'c':'(C) AP',
                'wsi':'(WSI) AP',
                'wsd':'(WSD) AP',
                'nwsi':'(NWSI) AP',
                'nwsd':'(NWSD) AP',
                'cat':'(CAT) AP',
                'fimp':'(FMIP) AP',
                //'gock':'(GOCK) AP',
                'sick':'(SICK) AP',
                'tab':'(TAB) AP',
                'sw':'(SW) AP',
                'bl':'(BL) AP',
            }
            $('#reference').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#reference').append($("<option></option>")
                .attr("value", key).text(value));
            });

            $('#reference').prop('disabled', false);
            $('#reference').prop('required', true);
            break;
        case "2":
            options = {
                '':'',
                'a':'(A) SA',
                'b+':'(B+) SA',
                'b':'(B) SA',
                'c':'(C) SA',
                'wsi':'(WSI) SA',
                'wsd':'(WSD) SA',
                'nwsi':'(NWSI) SA',
                'nwsd':'(NWSD) SA',
                'cat':'(CAT) SA',
                //'fimp':'(FMIP) SA',
                'gock':'(GOCK) SA',
                'sick':'(SICK) SA',
                'tab':'(TAB) SA',
                'sw':'(SW) SA',
                'bl':'(BL) SA',
            }
            $('#reference').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#reference').append($("<option></option>")
                .attr("value", key).text(value));
            });

            $('#reference').prop('disabled', false);
            $('#reference').prop('required', true);
            break;
        case "3":
            options = {
                '':'',
                'a':'(A) HU',
                'b+':'(B+) HU',
                'b':'(B) HU',
                'c':'(C) HU',
                'wsi':'(WSI) HU',
                'wsd':'(WSD) HU',
                'nwsi':'(NWSI) HU',
                'nwsd':'(NWSD) HU',
                'cat':'(CAT) HU',
                //'fimp':'(FMIP) HU',
                'gock':'(GOCK) HU',
                'sick':'(SICK) HU',
                'tab':'(TAB) HU',
                'sw':'(SW) HU',
                'bl':'(BL) HU',
            }
            $('#reference').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#reference').append($("<option></option>")
                .attr("value", key).text(value));
            });

            $('#reference').prop('disabled', false);
            $('#reference').prop('required', true);
            break;
        case "4":
            options = {
                '':'',
                'a':'(A) MI',
                'b+':'(B+) MI',
                'b':'(B) MI',
                'c':'(C) MI',
                'wsi':'(WSI) MI',
                'wsd':'(WSD) MI',
                'nwsi':'(NWSI) MI',
                'nwsd':'(NWSD) MI',
                'cat':'(CAT) MI',
                //'fimp':'(FMIP) HU',
                'gock':'(GOCK) MI',
                'sick':'(SICK) MI',
                'tab':'(TAB) MI',
                'sw':'(SW) MI',
                'bl':'(BL) MI',
            }
            $('#reference').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#reference').append($("<option></option>")
                .attr("value", key).text(value));
            });

            $('#reference').prop('disabled', false);
            $('#reference').prop('required', true);
            break;
        default:
            
            $('#reference').prop('disabled', true);
            $('#reference').prop('required', false);
            break;
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

$('#cancel-box').on('click', function(){

    var boxid = $(this).attr('data-value');

    var c = confirm("Are you sure you want to cancel box changes to " + boxid + "?");

    if(c){
        $.ajax({
            url: "/portal/warehouse-management/box-management/cancelbox",
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
                window.open(response);
                location.href = '/portal/warehouse-management/box-management/';
            },
            error:function(response){
                alert(response.responseText);
            }
        });
    }
});

$('.select-to-remove-from-box').on('change', function(){

    var selected = [];

    $('.select-to-remove-from-box:checked').each(function() {
        selected.push($(this).attr('id'));
    });

    if(selected.length > 0){
        $('#remove-device-from-box').prop('disabled', false);
    }
    else{
        $('#remove-device-from-box').prop('disabled', true);
    }

});

$('#remove-device-from-box').on('click', function(){

    var c = confirm("Are you sure you want to remove selected devices from box?");

    if(c){
        var selected = [];

        $('.select-to-remove-from-box:checked').each(function() {
            selected.push($(this).attr('id'));
        });

        $.ajax({
            url: "/portal/warehouse-management/box-management/removedevices",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                selected:selected,
            },
            success:function(response){
                location.reload();
            },
        });
    }

});

$(document).ready(function(){

    if(document.getElementsByClassName('completebox').length>0){
        $('.completebox').hide();
        $('#showboxed').css('opacity', 0.65);
    }

    $('#quarantine-overview-table tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var quarantineTable = $('#quarantine-overview-table').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "pageLength":-1,
    });
    
    // Apply the search
    quarantineTable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });

});

if(document.getElementById("cancel-box")){
    $('select').on('change', function(){
        if($('#manifacturer').val() != '' && $('#reference').val() != ''){
            var manufacturer = $('#manifacturer').val();
            var reference = $('#reference').val();
            var network = $('#network').val();
    
            $.ajax({
                url: "/portal/warehouse-management/getboxnumber",
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    manufacturer:manufacturer,
                    reference:reference,
                    network:network
                },
                success:function(response){
                    $('#number').val('0' + (parseInt(response) + 1));
                },
            });
        }
    });
}

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
            window.open(data.filename);
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

$('#newtray').on('change', function(){
    var newTrayId = $(this).val();
    console.log(newTrayId);

    $.ajax({
        url: "/portal/quarantine/check-allocation",
        type:"POST",
        data:{
            newTrayId:newTrayId,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success:function(data, textStatus, xhr){
            $('#submitallocation').prop("disabled", false);
        },
        error:function(data){
            alert(data.responseText);
        }
    });
});
