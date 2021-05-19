<!DOCTYPE html>

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
            <div class="alert alert-success">
                <ul>
                    <li>{{Session::get('success')}}</li>
                </ul>
            </div>
            @endif
        </div>

        <div></div>

        <div class="portal-table-container">

            <table class="portal-table" id="users-table">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>First Name</td>
                        <td>Surename</td>
                        <td>Email Address</td>
                        <td>Created</td>
                        <td>
                            <a href="/portal/user/add">
                            <i class="fa fa-plus-circle"></i>
                            </a>
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
                        <td>

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
                        <td>
                            <div class="table-element">
                                <a href="/portal/user/edit/{{$user->id}}" title="Edit user details">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="/portal/user/delete/{{$user->id}}" title="Delete user">
                                    <i class="fa fa-times remove"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@endsection

