@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Promotional Devices</p>
        </div>
    </div>
    <div class="portal-content-container">

        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">

            <div class="d-flex flex-wrap w-100">
                <a href="/portal/promodevices/main-site" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Main Site promotional devices </p>
                    </div>
                </a>

                <a href="/portal/promodevices/map-site" class="col-2 my-2">
                    <div class="portal-content-element" >
                            <p>Map page promotional devices </p>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>

@endsection