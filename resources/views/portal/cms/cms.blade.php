@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Add CMS Content </p>
        </div>
    </div>

    <div class="">
        <form action="/portal/cms/addItem" method="POST" enctype="multipart/form-data" >
            @csrf

            <div class="form-group">
                <label for="cms_type" class="label-required">Select CMS Type:</label>
                <select class="form-control" id="cms_type" name="cms_type" required>
                    <option value="" selected disabled>Select CMS Type</option>
                    <option value="news">News</option>
                    <option value="blog">Blog</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cms_title" class="label-required">Type CMS title:</label>
                <input type="text" name="cms_title" id="cms_title" required>
            </div>

            <div class="form-group">
                <label for="cms_parg_1" class="label-required">Type CMS paragraph 1:</label>
                <textarea type="text" class="form-control" name="cms_parg_1" id="cms_parg_1" required></textarea>
            </div>

            <div class="form-group">
                <label for="cms_parg_2">Type CMS paragraph 2:</label>
                <textarea type="text" class="form-control" name="cms_parg_2" id="cms_parg_2"></textarea>
            </div>

            <div class="form-group">
                <label for="cms_parg_3">Type CMS paragraph 3:</label>
                <textarea type="text" class="form-control" name="cms_parg_3" id="cms_parg_3"></textarea>
            </div>

            <div class="form-group">
                <label for="add_image_1">Add image 1:</label>
                <input type="file" name="add_image_1" id="add_image_1" accept="image/*"  required>
            </div>

            <div class="form-group">
                <label for="add_image_2">Add image 2:</label>
                <input type="file" name="add_image_2" id="add_image_2" accept="image/*" >
            </div>

            <div class="form-group">
                <label for="add_image_3">Add image 3:</label>
                <input type="file" name="add_image_3" id="add_image_3" accept="image/*" >
            </div>

            <input type="submit" class="btn btn-primary btn-blue" value="Add content">

        </form>
    </div>
</div>

@endsection