@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Clients</p>
        </div>
    </div>
    <div class="portal-table-container">

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="d-flex justify-content-between">

            <div class="col-md-3">

                <div class="d-flex">
                    <form action="/portal/settings/clients/add" style="width: 100%;" method="post">
                        @csrf
            
                        <div class="form-group">
                            <label for="account_name">Account Name:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="account_name" name="account_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_name">Contact Name:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="contact_name" name="contact_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="address" name="address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="post_code">Post Code:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="post_code" name="post_code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country">Country:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="country" name="country">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Contact email:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="email" id="contact_email" name="contact_email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_number">Contact number:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="number" id="contact_number" name="contact_number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vat_code">Sales VAT code:</label>
                            <div class="d-flex align-items-center">
                                <select class="form-control m-0" name="vat_code" id="vat_code">
                                    <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T4">T4</option>
                                    <option value="T9">T9</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_type">Sales Payment Type:</label>
                            <div class="d-flex align-items-center">
                                <select class="form-control m-0" name="payment_type" id="payment_type">
                                    <option value="Transfer">Transfer</option>
                                    <option value="Credit Account">Credit Account</option>
                                    <option value="Upfont">Upfront</option>
                                </select>
                            </div>
                        </div>
                    
                        <input type="submit" class="btn btn-primary btn-blue" value="Submit" onclick="return confirm('Are you sure you want to add client?')">
            
                    </form>
                </div>

            </div>

            <div class="col-md-9">
                <div class="d-flex flex-column my-5">
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td>Account name</td>
                            <td>Contact name</td>
                            <td>Address</td>
                            <td>Post Code</td>
                            <td>Country</td>
                            <td>Contact email</td>
                            <td>Contact number</td>
                            <td>Sales VAT Code</td>
                            <td>Payment Type</td>
                            <td>Delete</td>
                        </tr>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->account_name}}</td>
                            <td>{{$client->contact_name}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->post_code}}</td>
                            <td>{{$client->country}}</td>
                            <td>{{$client->contact_email}}</td>
                            <td>{{$client->contact_number}}</td>
                            <td>{{$client->vat_code}}</td>
                            <td>{{$client->payment_type}}</td>
                            <td><button class="btn btn-primary deleteclient" data-value="{{$client->id}}">Delete</button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection