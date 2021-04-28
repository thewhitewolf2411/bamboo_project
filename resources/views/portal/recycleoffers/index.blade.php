@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container row">
            <div class="portal-title">
                <p>Recycle Offers</p>
            </div>

            <a class="btn btn-green add-recycle-offer-btn" href="{{route('showCreateRecycleOffer')}}">New offer</a>
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


        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Device</th>
                {{-- <th scope="col">Offer title</th>
                <th scope="col">Offer price</th>
                <th scope="col">Period</th>--}}
                <th scope="col">Status</th> 
                <th scope="col" class="no-border-lr"></th>
                <th scope="col" class="no-border-lr"></th>
                <th scope="col" class="no-border-lr"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($recycleOffers as $recycleOffer)
                    <tr>
                        <td>{!!$recycleOffer->getDevice()!!}</td>
                        {{-- <td>{!!$recycleOffer->offer_title!!}</td> --}}
                        {{-- <td>£ {!!$recycleOffer->offer_price!!}</td> --}}
                        {{-- <td>{!!$recycleOffer->getStartDate()!!} - {!!$recycleOffer->getEndDate()!!}</td> --}}
                        <td>@if($recycleOffer->status) Active @else Inactive @endif</td>
                        <td><a href="{{route("activateRecycleOffer", ['id' => $recycleOffer->id])}}">
                            <i class="fa @if($recycleOffer->status) fa-toggle-on @else fa-toggle-off @endif edit-offer" style="color: black;"></i></a>
                        </td>
                        <td><a href="{{route("editRecycleOffer", ['id' => $recycleOffer->id])}}"><i class="fa fa-edit edit-offer" style="color: black;"></i></a></td>
                        <td><a class="delete-offer" href="{{route("deleteRecycleOffer", ['id' => $recycleOffer->id])}}"><i class="fa fa-trash edit-offer" style="color: black;"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    
    <script>

        (function() {
            let btns = document.getElementsByClassName('delete-offer');

            if(btns.length > 0){
                for (let index = 0; index < btns.length; index++) {
                    btns[index].addEventListener('click', function(){
                        event.preventDefault();
                        var path = this.href;
                        if(confirm('Are you sure you want to delete this recycle offer?')){
                            window.location = path;
                        }
                    });
                    
                }
            }
            
        })();
        
    </script>
@endsection
