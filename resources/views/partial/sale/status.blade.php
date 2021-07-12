<p class="section-item-title-regular">Thanks for your sale! Check out the details below</p>
{{-- <pre class="text-center">
{!!$tradein->getDeviceStatus()[1]!!} - [{!!$tradein->job_state!!}]
</pre> --}}

<div class="sale-status-row justify-content-center">
    @if(App\Services\ProfileService::getSaleStatus($tradein)['first_roundel'] !== null)
        <div class="sale-status-col first">
            <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['first_roundel']}}">
            <p class="sale-status-text">{{App\Services\ProfileService::getSaleStatus($tradein)['first_roundel_text']}}</p>
        </div>
    @endif
    @if(App\Services\ProfileService::getSaleStatus($tradein)['second_roundel'] !== null)
        @if(App\Services\ProfileService::getSaleStatus($tradein)['first_roundel'] !== null)
            <div class="sale-status-grey-line"></div>
        @endif
        <div class="sale-status-col second">
            <img class="sale-status-img-mobile" src="{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel']}}">
            <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel']}}">
            <p class="sale-status-text @if(App\Services\ProfileService::getSaleStatus($tradein)['third_roundel'] === null) bold @endif">{{App\Services\ProfileService::getSaleStatus($tradein)['second_roundel_text']}}</p>
        </div>
    @endif
    @if(App\Services\ProfileService::getSaleStatus($tradein)['third_roundel'] !== null)
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col third">
            <img class="sale-status-img" src="{{App\Services\ProfileService::getSaleStatus($tradein)['third_roundel']}}">
            <p class="sale-status-text bold">{{App\Services\ProfileService::getSaleStatus($tradein)['third_roundel_text']}}</p>
        </div>
    @endif
    
</div>

<p class="sale-status-information text-center mt-4 mb-2">{!!App\Services\ProfileService::getSaleStatus($tradein)['sale_status']!!}</p>

{{-- leave a review after sale complete --}}
@if(App\Services\ProfileService::saleComplete($tradein))
    <a href="https://uk.trustpilot.com/evaluate/bamboomobile.co.uk" class="leave-review-btn" target="_blank">
        <p>Leave a review</p>
        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}">
    </a>
@endif
