@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Reports Overview </p>
        </div>
    </div>
    <div class="portal-table-container">

        <a role="button" id="generate-overview-report-btn">

            <div class="btn btn-primary btn-blue">
                Generate Overview Report
            </div>

        </a>

        <!--<table class="portal-table sortable" id="categories-table">
            <tr>
                <td><div class="table-element">Trade in ID</div></td>
                <td><div class="table-element">Trade in barcode</div></td>
                <td><div class="table-element">Manufacturer</div></td>
                <td><div class="table-element">Model</div></td>
                <td><div class="table-element">IMEI</div></td>
                <td><div class="table-element">Network</div></td>
                <td><div class="table-element">Colour</div></td>
                <td><div class="table-element">Offer price</div></td>
                <td><div class="table-element">Paid Price</div></td>
                <td><div class="table-element">Admin</div></td>
                <td><div class="table-element">Logistics</div></td>
                <td><div class="table-element">Total</div></td>
                <td><div class="table-element">Customer Grade</div></td>
                <td><div class="table-element">Customer Grade after testing</div></td>
                <td><div class="table-element">Bamboo Grade</div></td>
                <td><div class="table-element">Customer status</div></td>
                <td><div class="table-element">Bamboo status</div></td>
                <td><div class="table-element">Fully Functional</div></td>
                <td><div class="table-element">Date Order placed</div></td>
                <td><div class="table-element">TP Despatch Date</div></td>
                <td><div class="table-element">Date Received</div></td>
                <td><div class="table-element">Expiry Date</div></td>
                <td><div class="table-element">Date Tested</div></td>
                <td><div class="table-element">Return Date</div></td>
                <td><div class="table-element">Quarantine Date</div></td>
                <td><div class="table-element">Quarantine Reason</div></td>
                <td><div class="table-element">Box Date</div></td>
                <td><div class="table-element">Processor Name</div></td>
                <td><div class="table-element">Quarantine</div></td>
                <td><div class="table-element">FMIP</div></td>
                <td><div class="table-element">Stock Location</div></td>
            </tr>
        </table>-->


    </div>
</div>


@endsection