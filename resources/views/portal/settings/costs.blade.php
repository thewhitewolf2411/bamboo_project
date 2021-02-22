@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Service Costs</p>
        </div>
    </div>
    <div class="portal-table-container">

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <form action="/portal/settings/costs/update" method="post">
            @csrf

            <div class="form-group">
                <label for="admin_costs">Administration costs: (format '£x.xx')</label>
                <div class="d-flex align-items-center">
                    <p>£</p>
                    <input class="form-control m-0" type="number" step="0.01" id="administration_costs" name="administration_costs" value="{{$additionalCosts->administration_costs}}">
                </div>
            </div>
        
            <div class="form-group">
                <label for="logistics_costs">Carriage: (format '£x.xx')</label>
                <div class="d-flex align-items-center">
                    <p>£</p>
                    <input class="form-control m-0" type="number" step="0.01" id="carriage_costs" name="carriage_costs" value="{{$additionalCosts->carriage_costs}}">
                </div>
            </div>

            <div class="form-group">
                <label for="miscellaneous_costs_total">Miscellaneous total: (format '£x.xx')</label>
                <div class="d-flex align-items-center">
                    <p>£</p>
                    <input class="form-control m-0" type="number" step="0.01" id="miscellaneous_costs_total" name="miscellaneous_costs_total" value="{{$additionalCosts->miscellaneous_costs_total}}">
                </div>
            </div>

            <div class="form-group">
                <label for="miscellaneous_costs_individual">Individual Miscellaneous cost: (format '£x.xx')</label>
                <div class="d-flex align-items-center">
                    <p>£</p>
                    <input class="form-control m-0" type="number" step="0.01" id="miscellaneous_costs_individual" name="miscellaneous_costs_individual" value="{{$additionalCosts->miscellaneous_costs_individual}}">
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-blue" value="Change costs" onclick="return confirm('Are you sure you want to update costs?')">

        </form>

    </div>
</div>

@endsection