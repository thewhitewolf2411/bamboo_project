@extends('portal.layouts.portal')

@section('content')


<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Map Site promotional devices</p>
        </div>
    </div>
    <div class="portal-content-container">
        @if(Session::has('map_promo_success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('map_promo_success')}}
            </div>
        @endif

        <form action="{{route('editMapPromoDevices')}}" method="POST" class="w-100">
            @csrf

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-1-1">First promotional mobile device</label>
                        <select id="promo-option-1-1" name="promo-option-1-1" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 1)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(1,1)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-1-2">First promotional tablet device</label>
                        <select id="promo-option-1-2" name="promo-option-1-2" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 2)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(1,2)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-1-3">First promotional smart watch</label>
                        <select id="promo-option-1-3" name="promo-option-1-3" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 3)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(1,3)}}</b></p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-2-1">Second promotional mobile device</label>
                        <select id="promo-option-2-1" name="promo-option-2-1" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 1)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(2,1)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-2-2">Second promotional tablet device</label>
                        <select id="promo-option-2-2" name="promo-option-2-2" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 2)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(2,2)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-2-3">Second promotional smart watch</label>
                        <select id="promo-option-2-3" name="promo-option-2-3" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 3)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(2,3)}}</b></p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-3-1">Third promotional mobile device</label>
                        <select id="promo-option-3-1" name="promo-option-3-1" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 1)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(3,1)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-3-2">Third promotional tablet device</label>
                        <select id="promo-option-3-2" name="promo-option-3-2" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 2)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(3,2)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-3-3">Third promotional smart watch</label>
                        <select id="promo-option-3-3" name="promo-option-3-3" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 3)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(3,3)}}</b></p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-4-1">Fourth promotional mobile device</label>
                        <select id="promo-option-4-1" name="promo-option-4-1" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 1)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(4,1)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-4-2">Fourth promotional tablet device</label>
                        <select id="promo-option-4-2" name="promo-option-4-2" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 2)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(4,2)}}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promo-option-4-3">Fourth promotional smart watch</label>
                        <select id="promo-option-4-3" name="promo-option-4-3" class="form-control">
                            <option value="">Select a device</option>
                            @foreach ($devices as $device)
                                @if($device->category_id === 3)
                                    <option value="{{$device->id}}">{{$device->product_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p>Currently selected device:<b>{{$selectedDevice->getDeviceName(4,3)}}</b></p>
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