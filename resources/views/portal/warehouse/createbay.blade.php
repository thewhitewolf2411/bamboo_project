@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Bay Overview </p>
        </div>
    </div>

    <div class="portal-search-form-container">
        <form action="/portal/warehouse-management/bay-overview/createbay" method="POST">
            @csrf
            <div class="container form-group d-flex flex-column align-items-center justify-content-between">
               
                <input required style="margin: 0; width: 30%; margin-bottom:15px;" class="p-2 form-control" type="text" name="bay_name" id="bay_name" placeholder="Bay Name">
                <button type="submit" class="btn btn-primary btn-blue">Create Bay</button>
            </div>
        </form>

        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
    </div>
</div>

@endsection