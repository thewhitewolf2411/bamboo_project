@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Settings</p>
            </div>
        </div>
        <div class="portal-content-container">

            <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
                <div class="d-flex flex-wrap w-100">
                    <a href="/portal/settings/product-options" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Product Options</p>
                        </div>
                    </a>
                    <a href="/portal/settings/promotional-codes" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Promotional Codes</p>
                        </div>
                    </a>
                    <a href="/portal/settings/brands" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Manufacturers</p>
                        </div>
                    </a>
                    <a href="/portal/settings/costs" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Service Costs</p>
                        </div>
                    </a>
                    <a href="/portal/settings/non-working-days" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Edit Non-working Days</p>
                        </div>
                    </a>
                    <a href="/portal/settings/clients" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Clients</p>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
@endsection