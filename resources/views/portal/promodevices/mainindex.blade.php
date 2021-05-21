@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Main page promotional devices</p>
        </div>
    </div>
    <div class="portal-content-container">


        <form action="editMainPromoDevices" method="POST" class="w-100">
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