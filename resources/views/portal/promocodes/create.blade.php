@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Create Promotional Code</p>
        </div>
    </div>
    <div class="container">

        <div class="d-flex flex-column">

            <form method="POST" action="{{route('createPromocode')}}">
                @csrf

                <div class="d-flex flex-row justify-content-around">
                    <div class="form-group mr-5">
                        <label for="name">Name:</label>
                        <input type="text" class="form-input" name="name" required/>
                    </div>
    
                    <div class="form-group">
                        <label for="name">Value (%):</label>
                        <input type="number" class="form-input" name="value" required/>
                    </div>
                </div>
                
                <div class="d-flex flex-row justify-content-around">

                    <div class="form-group mr-5">
                        <label for="name">Code:</label>
                        <input type="text" class="form-input" name="promotional_code" required/>
                    </div>

                    <div class="form-group">
                        <label for="name">Expires at:</label>
                        <input type="date" min="{{\Carbon\Carbon::now()->addDays(7)->format('Y-m-d')}}" class="form-input" name="expires_at" required/>
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