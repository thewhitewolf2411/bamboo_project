@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Mobile</p>
        </div>
    </div>
    <div class="portal-content-container">

        @if($portalUser->recycle)
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="">
                <h5>Recycle</h5>
            </div>
            <div class="d-flex flex-wrap w-100">
                @if($portalUser->trade_pack_despatch)

                <a href="/portal/customer-care/trade-in/all" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Trade-pack Despatch </p>
                    </div>
                </a>

                @endif

                @if($portalUser->awaiting_receipt)

                <a href="/portal/customer-care/trade-pack" class="col-2 my-2">
                    <div class="portal-content-element" >
                            <p>Awaiting Receipt </p>
                    </div>
                </a>

                @endif

                @if($portalUser->receiving)

                <a href="/portal/testing/receive" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Receiving </p>
                    </div>
                </a>

                @endif

                @if($portalUser->device_testing)

                <a href="/portal/testing/find" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Device Testing </p>
                    </div>
                </a>

                @endif

                @if($portalUser->trolley_management)

                <a href="/portal/trolleys" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Trolley Management</p>
                    </div>
                </a>

                @endif

                @if($portalUser->trays_managment)

                <a href="/portal/trays" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Trays Management </p>
                    </div>
                </a>

                @endif

                @if($portalUser->quarantine_managment)

                <a href="/portal/quarantine" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Quarantine Management </p>
                    </div>
                </a>

                @endif

                @if($portalUser->warehouse_management)

                <a href="/portal/warehouse-management" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Warehouse Management </p>
                    </div>
                </a>

                @endif

                @if($portalUser->sales_lots)
                    <a href="/portal/sales-lot" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Sales Lots </p>
                        </div>
                    </a>
                @endif

                @if($portalUser->despatch)
                    <a href="/portal/despatch" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Despatch </p>
                        </div>
                    </a>
                @endif

            </div>

        </div>
        @endif

        @if($portalUser->buying)
        <!--
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="">
                <h5>E-commerce</h5>
            </div>
            <div class="d-flex flex-wrap w-100">
                @if($portalUser->ecommerence_orders)


                <a href="/portal/ecommerence/order-management" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Order Management </p>
                    </div>
                </a>

                @endif

                @if($portalUser->ecommerence_users)

                <a href="/portal/ecommerence/customer-accounts" class="col-2 my-2">
                    <div class="portal-content-element" >
                            <p>Customer accounts </p>
                    </div>
                </a>

                @endif

                @if($portalUser->selling_status)

                <a href="/portal/ecommerence/order-status" class="col-2 my-2">
                    <div class="portal-content-element">
                            <p>Order Status</p>
                    </div>
                </a>

                @endif

                @if($portalUser->ecommerence_create_order)

                <a href="/portal/ecommerence/create-order" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Create order</p>
                    </div>
                </a>

                @endif

            </div>

        </div>
        -->
        @endif

        @if($portalUser->customer_care)
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="">
                <h5>Customer Care</h5>
            </div>
            <div class="d-flex flex-wrap w-100">
                @if($portalUser->order_management)

                <a href="/portal/customer-care/order-managment" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Order Management </p>
                    </div>
                </a>

                @endif

                @if($portalUser->create_order)

                <a href="/portal/customer-care/createorder" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Create Order</p>
                    </div>
                </a>

                @endif

                @if($portalUser->customer_accounts)

                <a href="/portal/customer-care/seller" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Customer Accounts </p>
                    </div>
                </a>

                @endif

                @if($portalUser->messages)

                <a href="/portal/customer-care/messages" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Messages </p>
                    </div>
                </a>

                @endif
            </div>

        </div>
        @endif

        @if($portalUser->administration)
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="">
                <h5>Administration</h5>
            </div>
            <div class="d-flex flex-wrap w-100">
                @if($portalUser->salvage_models)

                <a href="/portal/product/selling-products" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Salvage Models </p>
                    </div>
                </a>

                @endif

                @if($portalUser->sales_models)

                <a href="/portal/product/buying-products" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Sales Models </p>
                    </div>
                </a>

                @endif

                @if($portalUser->feeds)

                <a href="/portal/feeds" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Feeds</p>
                    </div>
                </a>

                @endif

                @if($portalUser->users)

                <a href="/portal/user" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Users </p>
                    </div>
                </a>

                @endif

                @if($portalUser->reports)

                <a href="/portal/reports" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Reports </p>
                    </div>
                </a>

                @endif

                @if($portalUser->cms)

                <a href="/portal/cms" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>CMS </p>
                    </div>
                </a>

                @endif

                @if($portalUser->categories)

                <a href="/portal/categories" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Categories </p>
                    </div>
                </a>

                @endif

                @if($portalUser->settings)
               
                <a href="/portal/settings" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Settings </p>
                    </div>
                </a>

                @endif

                @if($portalUser->id === 1)
                    <a href="/portal/klaviyologs" class="col-2 my-2">
                        <div class="portal-content-element">
                            <p>Logs </p>
                        </div>
                    </a>
                @endif

                @if($portalUser->recycle_offers)
                    <a href="/portal/recycleoffers" class="col-2 my-2">
                        <div class="portal-content-element">
                            Recycle Offers
                        </div>
                    </a>
                @endif
            </div>

        </div>
        @endif

        @if($portalUser->payments)
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="">
                <h5>Payments</h5>
            </div>
            <div class="d-flex flex-wrap w-100">
                @if($portalUser->awaiting_payments)

                <a href="/portal/payments/awaiting" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Awaiting Payments</p>
                    </div>
                </a>

                @endif

                @if($portalUser->submit_payments)

                <a href="/portal/payments/submit" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Submit Payments</p>
                    </div>
                </a>

                @endif

                @if($portalUser->payment_confirmations)

                <a href="/portal/payments/confirm" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Payment Confirmations</p>
                    </div>
                </a>

                @endif

                @if($portalUser->failed_payments)

                <a href="/portal/payments/failed" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Failed Payments</p>
                    </div>
                </a>

                @endif
            </div>

        </div>
        @endif

    </div>
</div>
@endsection