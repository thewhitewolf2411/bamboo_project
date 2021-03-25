@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            @if(isset($blog))
            <p>Edit CMS Content "{{$blog->cms_title}}"</p>
            @else
            <p>Add CMS Content </p>
            @endif
        </div>
    </div>

    <div class="">
        <form @if(isset($blog)) action="/portal/editcmspost" @else action="/portal/addcmspost" @endif method="POST" enctype="multipart/form-data" >
            @csrf

            @if(isset($blog))
                <input type="hidden" name="blogid" value="{{$blog->id}}">
            @endif

            <div class="form-group">
                <label for="cms_type" class="label-required">Select CMS Type:</label>
                <select class="form-control" id="cms_type" name="cms_type" required>
                    @if(!isset($blog))<option value="" selected disabled>Select CMS Type</option>@endif
                    <option value="news" @if(isset($blog) && $blog->cms_type === 0) selected @endif)>News</option>
                    <option value="blog" @if(isset($blog) && $blog->cms_type === 1) selected @endif>Blog</option>
                    <option value="howto" @if(isset($blog) && $blog->cms_type === 2) selected @endif>How to with Boo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cms_title" class="label-required">Type CMS title:</label>
                <input type="text" name="cms_title" id="cms_title" @if(isset($blog)) value="{{$blog->cms_title}}" @endif required>
            </div>

            <div class="form-group">
                <label for="cms_parg_1" class="label-required">Type CMS paragraph 1:</label>
                <textarea type="text" class="form-control" name="cms_parg_1" id="cms_parg_1" required>@if(isset($blog)) {{$blog->cms_parg_1}} @endif</textarea>
            </div>

            <div class="form-group">
                <label for="cms_parg_2">Type CMS paragraph 2:</label>
                <textarea type="text" class="form-control" name="cms_parg_2" id="cms_parg_2">@if(isset($blog)) {{$blog->cms_parg_2}} @endif</textarea>
            </div>

            <div class="form-group">
                <label for="cms_parg_3">Type CMS paragraph 3:</label>
                <textarea type="text" class="form-control" name="cms_parg_3" id="cms_parg_3">@if(isset($blog)) {{$blog->cms_parg_3}} @endif</textarea>
            </div>

            <div class="@if(isset($blog)) row @endif">
                <div class="form-group @if(isset($blog)) col-md-4 @endif">
                    <label for="add_image_1">@if(isset($blog)) <p>Click on image to change image 1.</p><img src="/storage/news_images/{{$blog->image_1}}" width="100%"> @else Add image 1: @endif</label>
                    <input type="file" name="add_image_1" id="add_image_1" accept="image/*" @if(isset($blog)) @else required @endif>
                </div>
    
                <div class="form-group @if(isset($blog)) col-md-4 @endif">
                    <label for="add_image_2">@if(isset($blog)) <p>Click on image to change image 2.</p><img src="/storage/news_images/{{$blog->image_2}}" width="100%"> @else Add image 2: @endif</label>
                    <input type="file" name="add_image_2" id="add_image_2" accept="image/*">
                </div>
    
                <div class="form-group @if(isset($blog)) col-md-4 @endif">
                    <label for="add_image_3">@if(isset($blog)) <p>Click on image to change image 3.</p><img src="/storage/news_images/{{$blog->image_3}}"  width="100%"> @else Add image 3: @endif</label>
                    <input type="file" name="add_image_3" id="add_image_3" accept="image/*" >
                </div>
            </div>



            <input type="submit" class="btn btn-primary btn-blue" @if(isset($blog)) value="Edit content" @else value="Add content" @endif>

        </form>
    </div>
</div>

@endsection