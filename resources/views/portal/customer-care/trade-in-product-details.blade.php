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

    <title>Bamboo Recycle::Customer Care</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>View Trade-in Product #{{$tradein->barcode}}</p>
                    </div>
                </div>
                <div class="portal-content-container">

                    <div class="details_view three_columns" id="view_trade_in_product_info">
                        <div class="view_groups_container" id="view_trade__in_product_summary">
                            <legend>
                                <span class="title_name">Trade-In Product Summary</span>
                            </legend><div class="left_view pull-left col-sm-6 col-md-4">
                                <div class="view_group product_image col-sm-11 col-md-12">
                                    <label></label>
                                </div>
                                <div class="view_group trade_in_product_id col-sm-11 col-md-12">
                                    <label class="col-sm-8 col-md-6">Trade-In Product ID:</label>
                                    <div class="value"><span class="value_text">2311</span></div>
                                </div>
                                <div class="view_group product_name col-sm-11 col-md-12">
                                    <label class="col-sm-8 col-md-6">Product Name:</label>
                                    <div class="value"><span class="value_text">Apple iPhone 6 64GB</span></div>
                                </div>
                                <div class="view_group trade_in_status col-sm-11 col-md-12">
                                    <label class="col-sm-8 col-md-6">Trade-In Status:</label>
                                    <div class="value"><span class="value_text">New</span></div>
                                </div>
                                <div class="view_group imei col-sm-11 col-md-12">
                                    <label class="col-sm-8 col-md-6">IMEI:</label>
                                    <div class="value"><span class="value_text"><span class="no_detail">N/A</span></div>
                                </div>
                                <div class="form-group edit_imei_button"></div>
                            </div>
                        </div>
                        <div class="middle_view pull-left col-sm-6 col-md-4">
                            <div class="view_group product_type col-sm-11 col-md-12">
                                <label class="col-sm-8 col-md-6">Product Type:</label>
                                <div class="value"><span class="value_text">Mobile Phone</span></div>
                            </div>
                            <div class="view_group brand col-sm-11 col-md-12">
                                <label class="col-sm-8 col-md-6">Brand:</label>
                                <div class="value"><span class="value_text">Apple</span></div>
                            </div>
                            <div class="view_group trade_in_internal_status col-sm-11 col-md-12">
                                <label class="col-sm-8 col-md-6">Internal Status:</label>
                                <div class="value"><span class="value_text">New</span></div>
                            </div>
                        </div>
                        <div class="right_view pull-right col-sm-6 col-md-4">
                            <div class="view_group product_id col-sm-11 col-md-12">
                                <label class="col-sm-8 col-md-6">Product ID:</label>
                                <div class="value"><span class="value_text">11095</span></div>
                            </div>
                            <div class="view_group main_actions col-sm-11 col-md-12">
                                <label class="col-sm-8 col-md-6">Actions:</label>
                                <div class="value"><span class="value_text"></span></div>
                            </div>

                <div class="view_groups_container" id="view_trade__in_product_additional_info">
                    <legend>
                        <span class="title_name">Trade-In Product Additional Info</span>
                    </legend>
                    <div class="left_view pull-left col-sm-6 col-md-4">
                        <div class="view_group specified_condition col-sm-11 col-md-12">
                            <label class="col-sm-8 col-md-6">Specified Condition:</label>
                            <div class="value"><span class="value_text">Good - Grade B</span></div>
                        </div>
                        <div class="view_group generated_condition col-sm-11 col-md-12">
                            <label class="col-sm-8 col-md-6">Generated Condition:</label>
                            <div class="value"><span class="value_text"><span class="no_detail">N/A</span></div>
                        </div>
                    </div>
                    <div class="view_group specified_price col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Specified Price:</label>
                        <div class="value"><span class="value_text">£75.00</span></div>
                    </div>
                    <div class="view_group generated_price col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Generated Price:</label>
                        <div class="value"><span class="value_text">£0.00</span></div>
                    </div>
                    <div class="view_group grade_with_aesthetics_score col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Grade With Aesthetics Score:</label>
                        <div class="value"><span class="value_text"><span class="no_detail">N/A</span></span></div>
                    </div>
                </div>
                <div class="middle_view pull-left col-sm-6 col-md-4">
                    <div class="view_group specified_product_option col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Specified Product Options:</label>
                        <div class="value">
                            <span class="value_text">
                                <div class="product_option">
                                    <span class="product_option_name">Condition:</span> 
                                    <span class="product_option_options">Good</span>
                                </div>
                                <div class="product_option">
                                    <span class="product_option_name">Networks:</span> 
                                    <span class="product_option_options">Unlocked</span>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="view_group generated_product_option col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Generated Product Options:</label>
                        <div class="value"><span class="value_text"><span class="no_detail">N/A</span></div>
                    </div>
                    <div class="view_group quarantined col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Quarantined:</label>
                        <div class="value"><span class="value_text">No</span></div>
                    </div>
                    <div class="view_group quarantine_reason col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Quarantine Reason:</label>
                        <div class="value"><span class="value_text">-</span></div>
                    </div>
                    <div class="view_group reconciled col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Reconciled:</label>
                        <div class="value"><span class="value_text">No</span></div>
                    </div>
                    <div class="view_group reconciled_date col-sm-11 col-md-12">
                        <label class="col-sm-8 col-md-6">Reconciled Date:</label>
                        <div class="value"><span class="value_text">-</span></div>
                    </div>
                </div>
                <div class="right_view pull-right col-sm-6 col-md-4"></div>
            </div>
        </div>

                </div>

            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
