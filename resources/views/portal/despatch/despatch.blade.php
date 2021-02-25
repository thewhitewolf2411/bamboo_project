@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <div class="row justify-content-around">
                            <p class="pt-2 text-center">Despatch devices</p>

                            <form class="d-flex align-items-center mx-5 text-center" action="/portal/dispatch/dispatchdevices" method="GET">              
                                <label for="searchtradeins">Search by Trade-in barcode:</label>
                                <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                                <button type="submit" class="btn btn-primary btn-blue">Search</button>
                                @if(isset(request()->search)) <a class="btn" href="/portal/dispatch/dispatchdevices">Cancel</a> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Devices</h5>
                    <table class="portal-table sortable">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Model</div></td>
                            <td><div class="table-element">Customer Name</div></td>
                            <td><div class="table-element">Postcode</div></td>
                            <td><div class="table-element">Address Line 1</div></td>
                            <td><div class="table-element">Bamboo Status</div></td>
                            <td><div class="table-element">Carrier</div></td>
                            <td><div class="table-element">Tracking Reference</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)
                            @if($tradein->canProccessPayment())
                                <tr id="tradein-{{$tradein->id}}">
                                    <td><div class="table-element">{{$tradein->barcode}}</div></td>
                                    <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                                    <td><div class="table-element">{{$tradein->getOrderDate()}}</div></td>
                                    <td><div class="table-element">{{$tradein->getProductName($tradein->id)}}</div></td>
                                    <td><div class="table-element">£ {{$tradein->bamboo_price}}</div></td>
                                    <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

</div>


@endsection