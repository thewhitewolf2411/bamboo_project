@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Product Options</p>
            </div>
        </div>
        <div class="portal-content-container">

            <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
                <div class="d-flex flex-wrap w-100">
                    <a href="/portal/settings/product-options/selling-colours" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Available selling colours</p>
                        </div>
                    </a>
                    <a href="/portal/settings/conditions/selling-networks" class="col-2 my-2">
                        <div class="portal-content-element">
                        <p>Available selling networks</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection