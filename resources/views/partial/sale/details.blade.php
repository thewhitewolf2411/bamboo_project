<div class="row m-0 justify-content-between">
    <div class="sale-detail-col">
        <div class="sale-row-1">
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Order #</p>
                <p class="sale-item-val">Order #{!!$tradein->barcode!!}</p>
            </div>
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Date of sale</p>
                <p class="sale-item-val">{!!$tradein->created_at->toFormattedDateString()!!}</p>
            </div>
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Device</p>
                <p class="sale-item-val">{!!$tradein->getProductName($tradein->id)!!}</p>
            </div>
        </div>
        <div class="sale-row-2">
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Memory</p>
                <p class="sale-item-val">{!!$tradein->getDeviceMemory()!!}</p>
            </div>
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Network</p>
                <p class="sale-item-val">{!!$tradein->getDeviceNetwork()!!}</p>
            </div>
            <div class="col sale-detail-infobox m-0">
                <p class="sale-item-label">Colour</p>
                <p class="sale-item-val">{!!$tradein->getDeviceColour()!!}</p>
            </div>
        </div>
    </div>
    <div class="sale-detail-col">
        <!-- labels and delivery notes popup -->
        @include('partial.labeldeliverynotes', ['tradein' => $tradein, 'btn_text' => 'Reprint Trade Pack & Label'])

        <a class="btn-purple sale-detail-btn large" href="#"><p>Email me a copy</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
        <a class="btn-blue sale-detail-btn large" href="/contact" target="_blank"><p>Get in touch</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
        @if(!$tradein->hasDeviceBeenReceived())
            <div class="btn-primary sale-detail-btn large cancelsale" data-toggle="modal" data-target="#cancelSaleModal"><p>Cancel Sale</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}"></div>
        @endif
    </div>
</div>