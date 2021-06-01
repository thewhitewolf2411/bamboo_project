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

    <title>Bamboo Recycle::Edit Category</title>
</head>

<body class="portal-body">
    <header>@include('portal.layouts.header')</header>
    
    <main class="portal-main">
        <div class="app">
        <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Edit Category</p>
                    </div>
                </div>
                <div class="add-product-container">

                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif

                    <form action="/portal/category/editcategory" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="category_id" value="{{$category->id}}">

                        <div class="product-tab">
                            <div class="form-group select_brand_button">
                                <label for="category_name">Category name:</label>
                                <input name="category_name" type="text" value="{{$category->category_name}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <label for="wordbox_description">Category description:</label>
                                <textarea id="description" class="form-control" name="wordbox_description" required>{{$category->category_description}}</textarea>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="category_image">Category image:</label>
                                    <input name="category_image" type="file" accept="image/x-png,image/gif,image/jpeg">
                                  </div>
                            </div>

                            <div class="form-group select_brand_button">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary btn-blue">Save changes</button>
                                  </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        
        </div>
    </main>

</body>
</html>