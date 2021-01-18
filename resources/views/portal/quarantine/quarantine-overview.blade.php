<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Quarantine Overview</title>
    <script src="{{ asset('js/Quarantine.js') }}"></script>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app p-5">
            <div class="container-fluid">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Quarantine Overview</p>
                    </div>
                </div>

                <div class="">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    <form action="/portal/quarantine/export-csv" method="post">
                        <table class="portal-table sortable" id="categories-table">
                            <tr>
                                <td><div class="table-element">Trade-in ID</div></td>
                                <td><div class="table-element">Trade-in Barcode</div></td>
                                <td><div class="table-element">Model</div></td>
                                <td><div class="table-element">IMEI</div></td>
                                <td><div class="table-element">Bamboo Status</div></td>
                                <td><div class="table-element">Quarantine Reason</div></td>
                                <td><div class="table-element">Stock location</div></td>
                                <td><div class="table-element">Order Date</div></td>
                                <td><div class="table-element">Quarantine Date</div></td>
                                <td><div class="table-element">Bamboo Grade</div></td>
                                <td><div class="table-element">Tag</div></td>
                            </tr>
                            @foreach($tradeins as $tradein)

                            <tr>
                                <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                                <td><div class="table-element">{{$tradein->barcode}}</div></td>
                                <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                                <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                                <td><div class="table-element">{{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0]}}</div></td>
                                <td><div class="table-element">
                                    @if($tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0] === "BLACKLISTED" && $tradein->quarantine_status == null)
                                    <select name="quarantinereasons" id="quarantinereasons-{{$tradein->id}}" class="form-control quarantinereasons">
                                        <option value="" disabled default selected>Select quarantine reason</option>
                                        <option value="1">Lost</option>
                                        <option value="2">Insurance Claim</option>
                                        <option value="3">Blocked / FRP</option>
                                        <option value="4">Stolen</option>
                                        <option value="5">Knox</option>
                                        <option value="6">Asset Watch</option>
                                    </select>
                                    @elseif($tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0] === "BLACKLISTED" && $tradein->quarantine_status != null)

                                        <div class="row w-100">
                                            <div class="col-md-9 d-flex align-items-center">
                                            <p>{{$tradein->getQuarantineReason($tradein->id)}}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <a onclick="removeQuarantineReason({{$tradein->id}})" class="btn btn-green" title="Remove quarantine reason">x</a>
                                            </div>
                                        </div>
                                        
                                    @else
                                        Not blacklisted
                                    @endif
                                </div></td>
                                <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                                <td><div class="table-element">{{$tradein->created_at}}</div></td>
                                <td><div class="table-element">{{$tradein->quarantine_date}}</div></td>
                                <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                                <td><div class="table-element"><input onclick="enablebtn()" class="exportbtn" type="checkbox" name="tradein-{{$tradein->id}}"></div></td>
                            </tr>

                            @endforeach
                        </table>

                        <div class="row">
                            <div class="col-md-2">
                                @csrf

                                <input id="export_csv" type="submit" class="btn btn-green" value="Export CSV" disabled>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </main>
    <script>
    
    $('.quarantinereasons').change(function(){

        var val = "";
        var id = this.id;
        var numval = this.value;

        console.log(numval);

        id = id.split('-')[1];

        switch(this.value){
            case "1":
                val = "Lost";
            break;

            case "2":
                val = "Insurance Claim";
            break;

            case "3":
                val = "Blocked / FRP";
            break;

            case "4":
                val = "Stolen";
            break;

            case "5":
                val = "Knox";
            break;

            case "6":
                val = "Asset Watch";
            break;
        }

        if(confirm('This will set quarantine reason as ' + val + '. Are you sure?')){
            console.log("here");
            $.ajax({
                url: "/portal/quarantine/addQuarantineStatus",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                    id: id,
                    val: numval,

                },
                success:function(response){
                    if(response == 200){
                        location.reload();
                    }
                },
            });
        }

    });

    function removeQuarantineReason(tradeinId){

        if(confirm('This will remove quarantine reason from this order. Are you sure?')){

            $.ajax({
                url: "/portal/quarantine/removeQuarantineStatus",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                    id: tradeinId,
                },
                success:function(response){
                    if(response == 200){
                        location.reload();
                    }
                },
            });
            
        }

    }
    
    function enablebtn(){

        var k=0;
        var chckbox = $('.exportbtn');

        for(var i=0; i<chckbox.length; i++){
            if(chckbox[i].checked){
                k++;
            }
        }

        if(k>0){
            $('#export_csv').prop("disabled", false);
        }

        else{
            $('#export_csv').prop("disabled", true);
        }

    }

    </script>

</body>
</html>
