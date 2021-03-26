@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>View existing cms</p>
        </div>
    </div>

    <div class="portal-table-container">

        <table class="portal-table " id="categories-table">
            <tr>
                <td><div class="table-element">Id</div></td>
                <td><div class="table-element">Type</div></td>
                <td><div class="table-element">Title</div></td>
                <td><div class="table-element">Author</div></td>
            </tr>

            @foreach($blogs as $blog)
            <tr class="cms-blog" data-value="{{$blog->id}}">
                <td><div class="table-element">{{$blog->id}}</div></td>
                <td><div class="table-element">{{$blog->getBlogType()}}</div></td>
                <td><div class="table-element">{{$blog->cms_title}}</div></td>
                <td><div class="table-element">{{$blog->author}}</div></td>
            </tr>

            @endforeach
        </table>

    </div>
</div>


<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="noteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Blog</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="color: black;" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-2 text-center">

            <div class="row mb-3">
                <div class="col-md-6">
                    <a id="deleteblog" data-value="">
                        <div class="btn btn-primary btn-blue">
                            Delete this blog
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a id="editblog" href="">
                        <div class="btn btn-primary btn-blue">
                            Edit this blog
                        </div>
                    </a>
                </div>
            </div>

            <table class="w-100 my-5">
                <tr>
                    <th>Type</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Last modified</th>
                </tr>
                <tr>
                    <td id="blog_type"></td>
                    <td id="blog_author"></td>
                    <td id="blog_title"></td>
                    <td id="blog_created"></td>
                    <td id="blog_modified"></td>
                </tr>
            </table>
            <div id="blog_content">
                <div class="row">
                    <div class="col-md-4">
                        <img id="image_1" src="" width="100%">
                    </div>
                    <div class="col-md-4">
                        <img id="image_2" src="" width="100%">
                    </div>
                    <div class="col-md-4">
                        <img id="image_3" src="" width="100%">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <p id="parag_1"></p>
                    </div>
                    <div class="col-md-4">
                        <p id="parag_2"></p>
                    </div>
                    <div class="col-md-4">
                        <p id="parag_3"></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>

@endsection