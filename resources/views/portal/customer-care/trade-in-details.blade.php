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

    <!-- Sortable -->
    <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Trade-in ID #{{$barcode}}</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>View Trade-in #{{$barcode}}</p>
                    </div>
                </div>
                <div class="portal-content-container">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-in Summary</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Trade-In ID:</p>
                                    <p>Trade-In Barcode:</p>
                                    <p>Payment Address</p>
                                    <p>Website/Store:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$barcode}}</p>
                                    <p>{{$tradeins[0]->barcode_original}}</p>
                                    <p></p>
                                    <p>Bamboo Recycle (Website)</p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Trade-In Placed:</p>
                                    <p>Collection Address</p>
                                    <p>Source:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$tradeins[0]->created_at->format('Y/m/d')}}</p>
                                    <p></p>
                                    <p>Website</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Payment and Delivery Details</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Payment Method:</p>
                                    <p>Delivery Method:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Total/Outstanding Payment Cost: </p>
                                    <p>Total/Outstanding Delivery Cost: </p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Free</p>
                                    <p>Free</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Customer Details</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Name: </p>
                                    <p>Contact No.:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$user->first_name}} {{$user->last_name}}</p>
                                    <p>{{$user->contact_number}}</p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Company Name: </p>
                                    <p>Email Address: </p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>none</p>
                                    <p>none</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="portal-table-container">
                    <div class="portal-title">
                        <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-In Products</p>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-In Product ID</div></td>
                            <td><div class="table-element">Name</div></td>
                            <td><div class="table-element">Customer Status</div></td>

                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->product_state}}</div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
