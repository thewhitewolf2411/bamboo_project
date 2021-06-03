@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Create Recycle Offer</p>
            </div>
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

        <form method="POST" enctype="multipart/form-data" action="{{route('createOffer')}}">
            @csrf

            <div class="d-flex flex-column">

                <div class="d-flex flex-column p-0">
                    <label for="device" class="ml-1 mb-2">Choose device:</label>
                    <select class="form-control w-25" name="device" required>
                        <option value="" disabled selected>Select device</option>
                        @foreach($devices as $device)
                            <option value="{!!$device->id!!}">{!!$device->product_name!!}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-column p-0 mt-2">
                    <label for="offer_image" class="ml-1 mb-2">Choose banner image:</label>
                    <input type="file" name="offer_image" accept="image/*" class="form-control" required>
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_mobile_image" class="ml-1 mb-2">Choose mobile banner image:</label>
                    <input type="file" name="offer_mobile_image" accept="image/*" class="form-control">
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_image" class="ml-1 mb-2">Choose selling banner image:</label>
                    <input type="file" name="offer_selling_banner_image" accept="image/*" class="form-control" required>
                </div>

                {{-- <div class="d-flex flex-column p-0">
                    <label for="offer_title" class="ml-1 mb-2">Offer title:</label>
                    <input type="text" class="form-control" name="offer_title" required>
                </div>

                <div class="d-flex flex-column p-0 mb-2">
                    <label for="offer_description" class="ml-1 mb-2">Offer description:</label>
                    <textarea class="form-control" name="offer_description" required></textarea>
                </div>

                <div class="d-flex flex-column p-0 mb-2">
                    <label for="offer_description" class="ml-1 mb-2">Offer additional info:</label>
                    <textarea class="form-control" name="offer_additional_info" required></textarea>
                </div>

                <div class="row m-0">
                    <div class="d-flex flex-column p-0 mb-2 mr-4">
                        <label for="offer_description" class="ml-1 mb-2">Start date:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" name="offer_start_date" required>
                    </div>
                    <div class="d-flex flex-column p-0 mb-2">
                        <label for="offer_description" class="ml-1 mb-2">End date:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" name="offer_end_date" required>
                    </div>
                </div>

                <div class="d-flex flex-column p-0">
                    <label for="offer_price" class="ml-1 mb-2">Offer price:</label>
                    <div class="row m-0">
                        <div class="pound-sign-newoffer">£</div>
                        <input type="text" class="form-control w-25 mt-auto mb-auto" name="offer_price" required>
                    </div>
                </div> --}}

                <button type="submit" class="btn btn-primary w-25 ml-auto mr-auto">Save</button>

            </div>
        </form>

    </div>
    
@endsection
