@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Non-working Dates</p>
            </div>
        </div>
        <div class="portal-table-container">

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif

        <table class="portal-table sortable" id="categories-table">
            <tr>
                <td><div class="table-element">Title</div></td>
                <td><div class="table-element">Date</div></td>
                <td><div class="table-element">Delete date from system</div></td>
            </tr>
            @foreach($nonWorkingDates AS $nWD)
            <tr>
                <td><div class="table-element">{{$nWD->day}}</div></td>
                <td><div class="table-element">{{$nWD->non_working_date}}</div></td>
                <td><div class="table-element"><a id="{{$nWD->id}}" class="deletedate"><div class="btn btn-primary btn-blue">Delete</div></a></div></td>
            </tr>
            @endforeach

        </table>
        
        <form action="/portal/settings/non-working-days/add-non-working-days" method="post" class="my-5">
            @csrf

            <div class="form-group">
                <label for="non_working_day_title">Add non-working day title:</label>
                <input class="form-control" type="text" id="non_working_day_title" name="non_working_day_title">
            </div>

            <div class="form-group">
                <label for="non_working_day">Add non-working day:</label>
                <input class="form-control" type="date" id="non_working_day" name="non_working_day">
            </div>
        

            <input type="submit" class="btn btn-primary btn-blue" value="Add non-working day" onclick="return confirm('Are you sure you want to add non-working day?')">

        </form>

        </div>
    </div>

@endsection