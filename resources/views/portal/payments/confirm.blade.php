<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <title>Bamboo Recycle::Completed Payment Jobs</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Payment Confirmations</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    <div class="row mb-4">
                        <h5 class="text-center m-auto">Devices submitted for payment</h5>


                        <form class="d-flex align-items-center ml-auto mr-auto text-center" action="/portal/payments/confirm" method="GET">              
                            <label for="searchbatches">Search by Reference/Barcode/ID:</label>
                            <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                            @if(isset(request()->search)) <a class="btn" href="/portal/payments/confirm">Cancel</a> @endif
                        </form>
                    </div>

                    <table class="portal-table sortable" id="batches-table">
                        <tr>
                            <td><div class="table-element">Device</div></td>
                            <td><div class="table-element">Customer</div></td>
                            <td><div class="table-element">Price</div></td>
                            <td><div class="table-element">Mark as successful</div></td>
                            <td><div class="table-element">Mark as failed</div></td>
                        </tr>
                        @foreach($devices as $batch_device)
                            @if($batch_device->payment_state === 1)
                                <tr>
                                    <td><div class="table-element">{!!$batch_device->model()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->customer()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->price()!!} £</div></td>
                                    <td><div class="table-element"><i class="fa fa-check" style="color:limegreen !important; cursor: default;"></i> Payment Successful</div>
                                    <td><div class="table-element"></div>
                                </tr>
                            @elseif($batch_device->payment_state === 2)
                                <tr>
                                    <td><div class="table-element">{!!$batch_device->model()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->customer()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->price()!!} £</div></td>
                                    <td><div class="table-element"></div>
                                    <td><div class="table-element"><i class="fa fa-times" style="color:darkred !important; cursor: default;"></i> Payment Failed</div>
                                </tr>
                            @else
                                <tr>
                                    <td><div class="table-element">{!!$batch_device->model()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->customer()!!}</div></td>
                                    <td><div class="table-element">{!!$batch_device->price()!!} £</div></td>
                                    <td><div class="table-element"><i class="fa fa-check" onclick="markAsSuccessful({!!$batch_device->id!!})"></i></div>
                                    <td><div class="table-element"><i class="fa fa-times" onclick="markAsFailed({!!$batch_device->id!!})"></i></div>    
                                </tr>
                            @endif
                        @endforeach
                    </table>

                </div>

            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

});


function markAsSuccessful(batchdeviceid){
    $.ajax({
        type: "POST",
        url: "{{ route('markAsSuccess')}}",
        data: {
            _token: '{{csrf_token()}}',
            batchdeviceid: batchdeviceid
        },
        success: function(data, textStatus, xhr) {            
            if(xhr.status === 200){
                alert('Device payment marked as successful.');
                window.location.reload(true);
            }
        },
        fail: function(xhr, textStatus, errorThrown){
            //
        }
    });
}

function markAsFailed(batchdeviceid){
    $.ajax({
        type: "POST",
        url: "{{ route('markAsFailed')}}",
        data: {
            _token: '{{csrf_token()}}',
            batchdeviceid: batchdeviceid
        },
        success: function(data, textStatus, xhr) {
            if(xhr.status === 200){
                alert('Device payment marked as failed.');
                window.location.reload(true);
            }
        },
        fail: function(xhr, textStatus, errorThrown){
            //
        }
    });
}

</script>


</html>
