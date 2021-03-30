//Tray Label
$('.printtraylabel').on('click', function(){

    var trayid = $(this).data('value');

    $.ajax({
        url: "/portal/trays/tray/printlabel",
        type:"POST",
        data:{
            trayid:trayid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $(document).ready(function(){
                $('#tradein-iframe').attr('src', '/' + response + '.pdf');
                $('#label-trade-in-modal').modal('show');
            });
        },
    });

});

//Trolley Label
$('.printtrolleylabel').on('click', function(){

    var trolleyid = $(this).data('value');

    $.ajax({
        url: "/portal/trolleys/trolley/printlabel",
        type:"POST",
        data:{
            trolleyid:trolleyid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $(document).ready(function(){
                $('#tradein-iframe').attr('src', '/' + response + '.pdf');
                $('#label-trade-in-modal').modal('show');
            });
        },
    });

});

$('.printbinlabel').on('click', function(){

    var binid = $(this).data('value');

    $.ajax({
        url: "/portal/quarantine-bins/printlabel",
        type:"POST",
        data:{
            binid:binid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $(document).ready(function(){
                $('#tradein-iframe').attr('src', '/' + response + '.pdf');
                $('#label-trade-in-modal').modal('show');
            });
        },
    });

});

$('.printbaylabel').on('click', function(){

    var bayid = $(this).data('value');

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/printbay",
        type:"POST",
        data:{
            bayid:bayid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $(document).ready(function(){
                $('#tradein-iframe').attr('src', '/' + response + '.pdf');
                $('#label-trade-in-modal').modal('show');
            });
        },
    });

});