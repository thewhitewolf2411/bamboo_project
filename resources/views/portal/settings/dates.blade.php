@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Non-working Dates</p>
            </div>
        </div>
        <div class="portal-table-container">

        <table class="portal-table sortable" id="categories-table">
            <tr>
                <td><div class="table-element">Title</div></td>
                <td><div class="table-element">Date</div></td>
                <td><div class="table-element">Delete</div></td>
                <td><div class="table-element">Add</div></td>
            </tr>

        </table>
        
        <form action="/portal/settings/costs/add-non-working-days" method="post">
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