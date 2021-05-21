@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Main page promotional devices</p>
        </div>
    </div>
    <div class="portal-content-container">

        @if(Session::has('promo_success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('promo_success')}}
            </div>
        @endif

        <form action="{{route('editMainPromoDevices')}}" method="POST" class="w-100">
            @csrf
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="promo-option-1">First popular device</label>
                        <select id="promo-option-1" name="promo-option-1" class="form-control">
                            @foreach ($devices as $device)
                                <option value="{{$device->id}}">{{$device->product_name}}</option>
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevices->getFirstDevice(true)}}</b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="promo-option-2">Second popular device</label>
                        <select id="promo-option-2" name="promo-option-2" class="form-control">
                            @foreach ($devices as $device)
                                <option value="{{$device->id}}">{{$device->product_name}}</option>
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevices->getSecondDevice(true)}}</b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="promo-option-3">Third popular device</label>
                        <select id="promo-option-3" name="promo-option-3" class="form-control">
                            @foreach ($devices as $device)
                                <option value="{{$device->id}}">{{$device->product_name}}</option>
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevices->getThirdDevice(true)}}</b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="promo-option-4">Fourth popular device</label>
                        <select id="promo-option-4" name="promo-option-4" class="form-control">
                            @foreach ($devices as $device)
                                <option value="{{$device->id}}">{{$device->product_name}}</option>
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevices->getFourhtDevice(true)}}</b></p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>

@endsection