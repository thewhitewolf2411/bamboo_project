<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>{{$title}}</p>
                    </div>
                </div>
                @if(Session::get('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{Session::get('error')}}</li>
                        </ul>
                    </div>
                @endif
                <div class="register-form-container">
                    <form method="POST" action="/portal/user/adduser">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group p20">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                            </div>
                            <div class="form-group p20">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-group p20">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="form-group p20">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group p20">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group p20">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                        </div>
                        <div class="portal-title">
                            <p>Access Level</p>
                        </div>
                        <div class="d-flex flex-wrap p20 access-container">
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="recycle" id="recycle">
                                <label class="form-check-label" for="recycle">Recycle</label>

                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="trade_pack_despatch" id="trade_pack_despatch">
                                    <label class="form-check-label" for="trade_pack_despatch">Trade Pack Despatch</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="awaiting_receipt" id="awaiting_receipt">
                                    <label class="form-check-label" for="awaiting_receipt">Awaiting Receipt</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="receiving" id="receiving">
                                    <label class="form-check-label" for="receiving">Receiving</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="device_testing" id="device_testing">
                                    <label class="form-check-label" for="device_testing">Device Testing</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="trolley_managment" id="trolley_managment">
                                    <label class="form-check-label" for="trolley_managment">Trolley Management</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="trays_managment" id="trays_managment">
                                    <label class="form-check-label" for="trays_managment">Trays Management</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="box_managment" id="box_managment">
                                    <label class="form-check-label" for="box_managment">Box Management</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="quarantine_managment" id="quarantine_managment">
                                    <label class="form-check-label" for="quarantine_managment">Quarantine Managment</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="warehouse_management" id="warehouse_management">
                                    <label class="form-check-label" for="warehouse_management">Warehouse Management</label>
                                </div>
                            </div>

                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="customer_care" id="customer_care">
                                <label class="form-check-label" for="customer_care">Customer Care</label>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="order_management" id="order_management">
                                    <label class="form-check-label" for="order_management">Order Management</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="create_order" id="create_order">
                                    <label class="form-check-label" for="create_order">Create Order</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="customer_accounts" id="customer_accounts">
                                    <label class="form-check-label" for="customer_accounts">Customer Accounts</label>
                                </div>
                            </div>

                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="administration" id="administration">
                                <label class="form-check-label" for="administration">Administration</label>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="salvage_models" id="salvage_models">
                                    <label class="form-check-label" for="salvage_models">Salvage Models</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="sales_models" id="sales_models">
                                    <label class="form-check-label" for="sales_models">Sales Models</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="feeds" id="feeds">
                                    <label class="form-check-label" for="feeds">Feeds</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="users" id="users">
                                    <label class="form-check-label" for="users">Users</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="reports" id="reports">
                                    <label class="form-check-label" for="reports">Reports</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="cms" id="cms">
                                    <label class="form-check-label" for="cms">Cms</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="categories" id="categories">
                                    <label class="form-check-label" for="categories">Categories</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="settings" id="settings">
                                    <label class="form-check-label" for="settings">Settings</label>
                                </div>
                            </div>

                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="payments" id="payments">
                                <label class="form-check-label" for="payments">Payments</label>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="awaiting_payments" id="awaiting_payments">
                                    <label class="form-check-label" for="awaiting_payments">Awaiting Payments</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="submit_payments" id="submit_payments">
                                    <label class="form-check-label" for="submit_payments">Submit Payments</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="payment_confirmations" id="payment_confirmations">
                                    <label class="form-check-label" for="payment_confirmations">Payment Confirmations</label>
                                </div>
                                <div class="form-group p20 w-25">
                                    <input type="checkbox" class="form-check-input" name="failed_payments" id="failed_payments">
                                    <label class="form-check-label" for="failed_payments">Failed Payments</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group p20">
                            <button type="submit" class="btn btn-primary btn-blue">Add new user</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

</body>



</html>


<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[8];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>