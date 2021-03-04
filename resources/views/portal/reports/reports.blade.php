@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Reports</p>
            </div>
        </div>

        <div class="portal-content-container">


            <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
                <div class="d-flex flex-wrap w-100">

                    <a href="/portal/reports/overview" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Overview </p>
                        </div>
                    </a>
    
                    <a href="/portal/reports/stock" class="col-2 my-2">
                        <div class="portal-content-element" >
                                <p>Stock </p>
                        </div>
                    </a>
    
                    <a href="/portal/reports/receiving" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Receiving </p>
                        </div>
                    </a>
    
                    <a href="/portal/reports/testing" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Testing </p>
                        </div>
                    </a>

                    {{-- <a href="/portal/reports/awaiting-payment" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Awaiting payment </p>
                        </div>
                    </a> --}}

                    <a href="/portal/reports/recycle-customer-returns" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Recycle customer returns </p>
                        </div>
                    </a>

                    <a href="/portal/reports/finance-recycle-reports" class="col-2 my-2">
                        <div class="portal-content-element">
                                <p>Finance Recycle reports </p>
                        </div>
                    </a>
    
                </div>
    
            </div>

  
        </div>

    </div>

@endsection