@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Users</p>
        </div>
    </div>
    <div class="portal-search-form-container">

        @if((Session::get('error') != null))
            <div class="alert alert-danger">
                <ul>
                    <li>{{Session::get('error')}}</li>
                </ul>
            </div>
        @endif

        @if(Session::has('success'))

            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>

        @endif


    </div>

    <div></div>

    <div class="portal-table-container">

        <table class="portal-table" id="users_table">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Username</td>
                    <td>First Name</td>
                    <td>Surename</td>
                    <td>Email Address</td>
                    <td>Created</td>
                    <td>Account disabled</td>
                    <td>
                        Options
                    </td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>Id</td>
                    <td>Username</td>
                    <td>First Name</td>
                    <td>Surename</td>
                    <td>Email Address</td>
                    <td>Created</td>
                    <td>Account disabled</td>
                    <td>
                        Options
                    </td>
                </tr>
            </tfoot>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>@if($user->account_disabled) Yes @else No @endif</td>
                    <td>
                        <div class="table-element">
                            <a href="/portal/customer-care/seller/{{$user->id}}" title="See user details">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a onclick="return confirm('Are you sure? This action will delete user and all records from the database.')" href="/portal/customer-care/seller/delete/{{$user->id}}" title="Delete user">
                                <i class="fa fa-trash"></i>
                            </a>
                            @if(!$user->account_disabled)
                            <a onclick="return confirm('Are you sure? This will stop user from being able to do any purchases and/or buyings from customer website?')" href="/portal/customer-care/seller/disable/{{$user->id}}" title="Disable user account">
                                <i class="fa fa-times remove"></i>
                            </a>
                            @else
                            <a onclick="return confirm('Are you sure? This will stop user from being able to do any purchases and/or buyings from customer website?')" href="/portal/customer-care/seller/enable/{{$user->id}}" title="Enable user account">
                                <i class="fa fa-check"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection
