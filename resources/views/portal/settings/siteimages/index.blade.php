@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Site images</p>
        </div>
    </div>
    <div class="portal-table-container">

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

        <div class="d-flex justify-content-between">

            <form action="/portal/settings/siteimages/set/about" enctype="multipart/form-data" style="width: 100%;" method="post">
                @csrf
                <div class="col w-25">
                    <h5 class="mb-3">About page current image</h5>

                    @if($about_page_image !== null)
                        <p class="m-0 mb-3 text-center h6">Current image</p>
                        <form id="delete_image_site"  action="/portal/settings/siteimages/deletesiteimage/{{$about_page_image->id}}" style="display:none;" method="POST">@csrf</form>
                        <img src="{{$about_page_image->getURL()}}" width="250px">
                        <div class="d-flex flex-row justify-content-center mb-4 mt-4">
                            <a href="/portal/settings/siteimages/delete/{{$about_page_image->id}}" title="Delete image">
                                <i class="fa fa-trash" style="color: black;" onclick="deleteImage({{$about_page_image->id}})"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center mb-3">Please select an image</div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                    <button type="submit" class="btn btn-dark w-100" value="save">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script type="application/javascript">

<script>
@endsection