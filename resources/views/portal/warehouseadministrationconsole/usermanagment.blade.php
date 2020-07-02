<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>@include('portal.layouts.header')</header>

        <div class="portal-header-container">
            <h3>Find User</h3>
        </div>

        <div class="all-users-container">
            <h4>Showing All Users</h4>
        </div>

        <div class="users-table-container">

            <table>
                <tr>
                    <th> First Name </th>
                    <th> Surname </th>
                    <th> Username </th>
                    <th> View user </th>
                </tr>
                @foreach($allUsers as $user)
                <tr>
                    <td> {{$user->first_name}} </td>
                    <td> {{$user->surename}} </td>
                    <td> {{$user->username}} </td>
                    <td> <a href="{{url('/portal/adminconsole/usermanagment/view/'.$user->id)}}">View User</a></td>
                </tr>
                @endforeach
            </table>
        </div>


    </body>
</html>