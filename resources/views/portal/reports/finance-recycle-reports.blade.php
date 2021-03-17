@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Finance Recycle reports </p>
        </div>
    </div>
    <div class="portal-table-container">

        <div class="row justify-content-center">
            <button class="btn btn-primary btn-blue ml-2 mr-2" id="purchased-report-btn" data-toggle="modal" data-target="#purchased-report-modal">
                Generate Purchased Units Report
            </button>

            <button class="btn btn-primary btn-blue ml-2 mr-2" id="current-report-btn" data-toggle="modal" data-target="#current-report-modal">
                Generate Current Status Report
            </button>

            <button class="btn btn-primary btn-blue ml-2 mr-2" id="transfer-report-btn" data-toggle="modal" data-target="#transfer-report-modal">
                Generate Device Transfer Report
            </button>

        </div>

        <div class="row justify-content-center mt-4" id="filters">
            <div class="col hidden" id="date-period-filter">
                <div class="col">
                    <h5 class="text-center"> Choose date period:</h5>
                </div>
                <div class="d-flex w-50 m-auto">
                    <div class="input-group mr-4">
                        <input type="date" name="from"/>
                    </div>
                    <div class="input-group">
                        <input type="date" name="to"/>
                    </div>
                </div>
            </div>
            <div class="row hidden" id="status-filter">
                <select class="form-control m-3" name="bamboo_status">
                    <option value="" disabled selected>Choose a status</option>
                </select>
            </div>
            <div class="row hidden" id="transfer_filter">
                <select class="form-control mx-3" name="transfer_status">
                    <option value="" disabled selected>Choose transfer option</option>
                </select>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="purchased-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Generate purchased report</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-4" id="filters">
                    <form action="/portal/reports/finance-recycle-reports/generate-purchased-report" method="POST" class="w-75">
                        @csrf
                        <div class="col" id="date-period-filter">
                            <div class="col">
                                <h5 class="text-center"> Choose date period:</h5>
                            </div>
                            <div class="d-flex m-auto">
                                <div class="input-group mr-4">
                                    <input type="date" name="from" required/>
                                </div>
                                <div class="input-group">
                                    <input type="date" id="max-date-2" name="to" required/>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="current-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Generate current report</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-4" id="filters">
                    <form action="/portal/reports/finance-recycle-reports/generate-current-report" method="POST" class="w-75">
                        @csrf
                        <div class="row" id="status-filter">
                            <select class="form-control m-3" name="bamboo_status">
                                <option value="" disabled selected>Choose a status</option>
                                <option value="all">All</option>

                                @foreach ($tradeins as $key=>$tradein)
                                    <option value="{{$key}}">{{$key}} | {{count($tradein)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transfer-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Generate transfer report</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-4" id="filters">
                    <form action="" method="POST" class="w-75">
                        @csrf
                        <div class="row" id="transfer_filter">
                            <select class="form-control m-3" name="transfer_status">
                                <option value="/portal/reports/finance-recycle-reports/generate-transfer-report" disabled selected>Choose transfer option</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

var today = new Date();
var dd = today.getDate()+1;
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("max-date-2").setAttribute("max", today);

</script>

@endsection