$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#generate-overview-report-btn').on('click', function(){

    $.ajax({
        url: "/portal/reports/getoverviewreport",
        type:"POST",
        success:function(response){
            window.open(response, "_blank");
        },
    });

});

$('#generate-stock-report-btn').on('click', function(){

    $.ajax({
        url: "/portal/reports/getstockreport",
        type:"POST",
        success:function(response){
            window.open(response, "_blank");
        },
    });

});

$('#generate-recycle-report-btn').on('click', function(){

    $.ajax({
        url: "/portal/reports/getrecyclecustomerreturnswreport",
        type:"POST",
        success:function(response){
            window.open(response, "_blank");
        },
    });

});


