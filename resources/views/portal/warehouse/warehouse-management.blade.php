@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Warehouse Management</p>
        </div>
    </div>
    <div class="portal-content-container">
        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="d-flex flex-wrap w-100">
                <a href="/portal/warehouse-management/box-management" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Box Management</p>
                    </div>
                </a>
                <a href="/portal/warehouse-management/bay-overview" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Bay Overview</p>
                    </div>
                </a>
                <a href="/portal/warehouse-management/picking-despatch" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Picking / Despatch Management </p>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>


@endsection