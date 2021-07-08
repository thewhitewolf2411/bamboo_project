<p class="section-item-title-regular">Thanks for your sale! Check out the details below</p>
{{-- <pre class="text-center">
{!!$tradein->getDeviceStatus()[1]!!} - [{!!$tradein->job_state!!}]
</pre> --}}

<div class="sale-status-row justify-content-center">
    <div class="sale-status-col first">
        <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['first_roundel']}}">
        <p class="sale-status-text">{{App\Services\ProfileService::getSaleStatus($tradein)['first_roundel_text']}}</p>
    </div>
    @if(App\Services\ProfileService::getSaleStatus($tradein)['second_roundel'] !== null)
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col second">
            <img class="sale-status-img-mobile" src="{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel']}}">
            <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel']}}">
            <p class="sale-status-text bold">{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel_text']}}</p>
        </div>
    @endif
    @if(App\Services\ProfileService::getSaleStatus($tradein)['third_roundel'] !== null)
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col third">
            <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['third_roundel']}}">
            <p class="sale-status-text">{{App\Services\ProfileService::getSaleStatus($tradein)['third_roundel_text']}}</p>
        </div>
    @endif
    
</div>

<p class="sale-status-information text-center mt-4 mb-2">{!!App\Services\ProfileService::getSaleStatus($tradein)['sale_status']!!}</p>