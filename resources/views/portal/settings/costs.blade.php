@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Edit costs</p>
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
                <label for="admin_costs">Update Admin costs:</label>
                <input class="form-control" type="number" step="0.01" id="admin_costs" name="admin_costs" value="{{$additionalCosts->admin_costs}}">
            </div>
        
            <div class="form-group">
                <label for="logistics_costs">Update Logistics costs:</label>
                <input class="form-control" type="number" step="0.01" id="logistics_costs" name="logistics_costs" value="{{$additionalCosts->logistics_costs}}">
            </div>

            <input type="submit" class="btn btn-primary btn-blue" value="Change costs" onclick="return confirm('Are you sure you want to update costs?')">

        </form>

    </div>
</div>

@endsection