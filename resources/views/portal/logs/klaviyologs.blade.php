@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="portal-title-container">
        <div class="portal-title">
            <div class="row justify-content-around">
                <p class="pt-2 text-center">Klaviyo Logs</p>
            </div>
        </div>
    </div>

    <pre class="logs-container">{{$data}}</pre>

</div>

@endsection