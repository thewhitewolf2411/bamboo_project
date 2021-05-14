@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container d-flex flex-row">
        <div class="portal-title">
            <p>Promotional codes</p>
        </div>
        <a href="/portal/promocodes/create" class="btn btn-primary ml-auto mb-auto mt-auto mr-0">Create</a>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success w-50 text-center ml-auto mr-auto" role="alert">
            {!!Session::get('success')!!}
        </div>
    @endif

    @if(Session::has('info'))
        <div class="alert alert-info w-50 text-center ml-auto mr-auto" role="alert">
            {!!Session::get('info')!!}
        </div>
    @endif

    <div class="portal-content-container">

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Value</th> 
                <th scope="col">Code</th> 
                <th scope="col" class="no-border-lr"></th>
                <th scope="col" class="no-border-lr"></th>
                {{-- <th scope="col" class="no-border-lr"></th> --}}
              </tr>
            </thead>
            <tbody>
                @foreach($promocodes as $code)
                    <tr>
                        <td>{!!$code->name!!}</td>
                        <td>{!!$code->value!!} %</td>
                        <td><pre>{!!$code->promotional_code!!}</pre></td>
                        <td><a href="{{route("editPromoCode", ['id' => $code->id])}}"><i class="fa fa-edit edit-offer" style="color: black;"></i></a></td>
                        <td><a class="delete-offer" href="{{route("deletePromoCode", ['id' => $code->id])}}"><i class="fa fa-trash edit-offer" style="color: black;"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


@endsection