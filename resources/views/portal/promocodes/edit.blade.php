@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="portal-title-container d-flex flex-row">
        <div class="portal-title">
            <p>Edit Promotional Code</p>
        </div>
        <a href="/portal/promocodes" class="btn btn-light ml-auto mb-auto mt-auto mr-0">Back</a>
    </div>

    <div class="container">

        <div class="d-flex flex-column">

            <form method="POST" action="{{route('updatePromoCode', ['id' => $promocode->id])}}">
                @csrf

                <div class="d-flex flex-row justify-content-around">
                    <div class="form-group mr-5">
                        <label for="name">Name:</label>
                        <input type="text" class="form-input" name="name" value="{!!$promocode->name!!}" required/>
                    </div>
    
                    <div class="form-group">
                        <label for="name">Value (%):</label>
                        <input type="number" class="form-input" value="{!!$promocode->value!!}" min="1" max="100" name="value" required/>
                    </div>
                </div>
                
                <div class="d-flex flex-row justify-content-around">

                    <div class="form-group mr-5">
                        <label for="name">Code:</label>
                        <input type="text" class="form-input" name="promotional_code" value="{!!$promocode->promotional_code!!}" required/>
                    </div>

                    <div class="form-group">
                        <label for="name">Expires at:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->addDays(7)->format('Y-m-d')}}" value="{!!$promocode->getExpiryDate()!!}" class="form-input" name="expires_at" required/>
                    </div>

                </div>

                <input type="hidden" name="apply_rules" id="apply_rules"/>

                <div class="form-group">
                    <label for="">Applies to:</label>
                    <select id="applies_to" class="form-control" required>
                        <option disabled value="" selected hidden>-</option>
                        <option value="single_device">Single device</option>
                    </select>
                </div>

                <div class="form-group hidden" id="single-device">
                    <label>Select device:</label>
                    <select id="device_applies_to" class="form-control">
                        <option disabled value="" selected hidden>Select device</option>
                        @foreach ($devices as $device)
                            <option value="{!!$device->id!!}">{!!$device->product_name!!}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-row justify-content-center">
                    <button type="submit" class="btn btn-secondary w-25 mt-4">Save</button>
                </div>
            </form>

        </div>

    </div>
</div>

<script type="application/javascript">
    window.addEventListener('DOMContentLoaded', (event) => {
        let applyrules = JSON.parse('{!!$promocode->apply_rules!!}');

        let option = document.getElementById('applies_to');
        let device_applies_to = document.getElementById('device_applies_to');
        let single_device =  document.getElementById('single-device');

        // single device
        if(applyrules.device_id){

            option.value = 'single_device';
            single_device.classList.remove('hidden');
            device_applies_to.required = 'required';
            device_applies_to.value = applyrules.device_id;

            document.getElementById('device_applies_to').addEventListener('change', function(){singleDevice();});
            singleDevice();
        }
    });

    document.getElementById('applies_to').addEventListener('change', function(){
        let option = document.getElementById('applies_to');
        let device_applies_to = document.getElementById('device_applies_to');
        let single_device =  document.getElementById('single-device');

        switch (option.value) {
            // single device
            case 'single_device':
                single_device.classList.remove('hidden');
                device_applies_to.required = 'required';

                document.getElementById('device_applies_to').addEventListener('change', function(){singleDevice();});

                break;
        
            default:
                break;
        }
    });

    function singleDevice(){
        let device = document.getElementById('device_applies_to').value;
        let rule = document.getElementById('apply_rules');

        let rulejson = {
            'device_id': device
        };
        rule.value = JSON.stringify(rulejson);
    }
</script>

@endsection