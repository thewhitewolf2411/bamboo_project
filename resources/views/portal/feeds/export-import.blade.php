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

    <title>Portal::Feeds Export/Import</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Feeds Export/Import</p>
                    </div>
                </div>
                <div class="portal-form-container export-import-container">
                    <h5>Product Details - Information</h5>
                    <div class="bb-grey"></div>

                    <form action="/portal/feeds/export-import/export" method="POST">
                        @csrf
                        <label><b>Export Feed:</b></label>
                        <select class="form-control" id="search_by_field" name="export_feed_parameter">
                            <option value="1">Sales products</option>
                            <option value="2">Recycle products</option>
                        </select>
                        <div class="export-import-submit-container">
                            <button type="submit" name="export-feed" class="btn btn-primary btn-blue">Export Feed</button>
                        </div>
                        
                    </form>
                    <div class="bb-grey"></div>
                    <form action="/portal/feeds/export-import/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label><b>Import Feed:</b></label>
                        <select class="form-control" id="search_by_field" name="export_feed_parameter">
                            <option value="1">Sales products</option>
                            <option value="2">Recycle products</option>
                        </select>
                        <input type="file" name="imported_csv" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <div class="export-import-submit-container">
                            <button type="submit" name="import-feed" class="btn btn-primary btn-blue">Upload Feed</button>
                        </div>
                    </form>

                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                        </div>
                    @endif

                    @if(Session::has('failed-info'))
                        <div class="alert alert-warning" role="alert">
                            @foreach(Session::get('failed-info') as $message)
                                <p>{!!$message!!}</p>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </main>

</body>

