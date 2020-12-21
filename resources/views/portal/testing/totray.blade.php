<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="/js/PrintTradeIn.js"></script>

    <title>Bamboo Recycle::Autoallocated Tray</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>


    <main class="portal-main">

        <script>
            setTimeout(function(){
                $.ajax({
                url: "/portal/receiving/printnewlabel",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                    file: "label-{{$tradein->barcode}}"
                },
                success:function(response){
                    console.log(response['code'], response.code);
                        if(response['code'] == 200){
                            $('#tradein-iframe').attr('src', '/' + response['filename']);
                            $('#label-trade-in-modal').modal('show');
                        }
                },
            });
            }, 2000)
        </script>

        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Autoallocated Tray</p>
                    </div>
                </div>

                Please put the device with new label into tray {{$tray_name}}.
                
                @if($testing ?? '')
                <a href="/portal/testing/find">
                    <div class="btn btn-primary">
                        <p style="color: #fff;">Back</p>
                    </div>
                </a>
                @else
                    @if($mti)
                    <a href="/portal/testing/receiveorder?scanid={{$tradein->barcode_original}}">
                        <div class="btn btn-primary">
                            <p style="color: #fff;">Back</p>
                        </div>
                    </a>
                    @else
                    <a href="/portal/testing/receive">
                        <div class="btn btn-primary">
                            <p style="color: #fff;">Back</p>
                        </div>
                    </a>
                    @endif
                @endif

            </div>
        </div>
    </main>

        <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Device label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="tradein-iframe"></iframe>
                </div>
                </div>
            </div>
		</div>

</body>


</html>
