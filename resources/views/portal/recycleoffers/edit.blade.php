@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container row">
            <div class="portal-title">
                <p>Edit Recycle Offer</p>
            </div>
            <a class="btn btn-light add-recycle-offer-btn" href="/portal/recycleoffers">Back</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger w-50 ml-auto mr-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{route('updateRecycleOffer', ['id' => $recycleOffer->id])}}">
            @csrf

            <div class="d-flex flex-column">

                <div class="d-flex flex-column p-0">
                    <label for="device" class="ml-1 mb-2">Choose device:</label>
                    <select class="form-control w-25" name="device" required>
                        @foreach($devices as $device)
                            @if($recycleOffer->device_id === $device->id)
                                <option value="{!!$device->id!!}" selected>{!!$device->product_name!!}</option>
                            @else
                                <option value="{!!$device->id!!}">{!!$device->product_name!!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-column p-0">
                    <label class="ml-auto mr-auto mt-2">Current banner image:</label>
                    <img class="offer-banner-preview" src="{{$recycleOffer->getImage()}}">
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_image" class="ml-1 mb-2">Choose new banner image:</label>
                    <input type="file" name="offer_image" accept="image/*" class="form-control">
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_title" class="ml-1 mb-2">Offer title:</label>
                    <input type="text" class="form-control" name="offer_title" value="{!!$recycleOffer->offer_title!!}" required>
                </div>

                <div class="d-flex flex-column p-0 mb-2">
                    <label for="offer_description" class="ml-1 mb-2">Offer description:</label>
                    <textarea class="form-control" name="offer_description" required>{!!$recycleOffer->offer_title!!}</textarea>
                </div>

                <div class="d-flex flex-column p-0 mb-2">
                    <label for="offer_description" class="ml-1 mb-2">Offer additional info:</label>
                    <textarea class="form-control" name="offer_additional_info" required>{!!$recycleOffer->offer_additional_info!!}</textarea>
                </div>

                <div class="row m-0">
                    <div class="d-flex flex-column p-0 mb-2 mr-4">
                        <label for="offer_start_date" class="ml-1 mb-2">Start date:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{!!$recycleOffer->getInputStartDate()!!}" class="form-control" name="offer_start_date" required>
                    </div>
                    <div class="d-flex flex-column p-0 mb-2">
                        <label for="offer_end_date" class="ml-1 mb-2">End date:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{!!$recycleOffer->getInputEndDate()!!}" class="form-control" name="offer_end_date" required>
                    </div>
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_price" class="ml-1 mb-2">Offer price:</label>
                    <div class="row m-0">
                        <div class="pound-sign-newoffer">£</div>
                        <input type="text" class="form-control w-25 mt-auto mb-auto" name="offer_price" value="{!!$recycleOffer->offer_price!!}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-25 ml-auto mr-auto">Save changes</button>

            </div>
        </form>

    </div>
    
@endsection
