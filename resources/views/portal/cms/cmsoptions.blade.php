@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>CMS </p>
        </div>
    </div>

    <div class="portal-content-container">

        <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
            <div class="d-flex flex-wrap w-100">
                <a href="/portal/addcms" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>Add new CMS content </p>
                    </div>
                </a>
                <a href="/portal/view" class="col-2 my-2">
                    <div class="portal-content-element">
                        <p>View existing CMS content </p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection