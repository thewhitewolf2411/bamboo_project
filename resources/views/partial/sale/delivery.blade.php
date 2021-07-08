<div class="row p-4 delivery-details-row">

    @if($tradein->trade_pack_send_by_customer === 0)
        <div class="label-print-type-column">
            <div class="label-print-type selected m-2">
                <div class="col p-0">
                    <img class="label-print-svg" src="{{asset('/customer_page_images/body/final_free_trade_pack.svg')}}">
                    <p class="label-print-text">FREE bamboo <br>Trade Pack</p>
                </div>
            </div>
            <img class="label-select-svg ml-auto mr-auto" id="bamboo-print-selected" src="{{asset('/customer_page_images/body/orange_selected.svg')}}">
            <div class="btn-purple sale-detail-btn auto-width mt-4 cursor-pointer ml-auto mr-auto" id="call-print-bamboo" onclick="print('{{$tradein->id}}')"><p>Re-Print Label</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></div>
        </div>
    @endif

    @if($tradein->trade_pack_send_by_customer === 1)
        <div class="label-print-type-column">
            <div class="label-print-type selected m-2">
                <div class="col p-0">
                    <img class="label-print-svg" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                    <p class="label-print-text">FREE print your <br>own label</p>
                </div>
            </div>
            <img class="label-select-svg ml-auto mr-auto" id="own-print-selected" src="{{asset('/customer_page_images/body/orange_selected.svg')}}">
            <div class="btn-purple sale-detail-btn auto-width mt-4 cursor-pointer ml-auto mr-auto" onclick="print('{{$tradein->id}}')" id="call-print-own" ><p>Re-Print Label</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></div>
        </div>
    @endif

    <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trade pack label</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span style="color: black;" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="tradein-iframe"></iframe>
            </div>
            </div>
        </div>
    </div>

    <div class="delivery-details-col">
        <p class="delivery-info-dates-label">Date Posted</p>
        <p class="delivery-info-dates-bold">{!!$tradein->created_at->format('d M, Y')!!}</p>
        <br>
        <p class="delivery-info-dates-label">Date Received</p>
        <p class="delivery-info-dates-bold">{{$tradein->getReceivedDate()}}</p>
    </div>
    <div class="delivery-details-col">
        {{-- <p class="delivery-info-dates-label">Enter Tracking Number</p> --}}
        <p class="delivery-info-dates-bold"></p>
        <a class="btn-purple sale-detail-btn large mt-4" id="call-print-own" href="#"><p>Edit Tracking Number</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
        <a class="btn-green sale-detail-btn large mt-1" id="call-print-own" href="https://www.royalmail.com/track-your-item#/" target="_blank"><p>Track Parcel</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
    </div>
</div>

<script type="application/javascript">

    function print(id){
        $.ajax({
            url: "/userprofile/printlabel/",
            method:"POST",
                data:{
                    _token: "{!! csrf_token() !!}",
                    tradein: id,  
                },
            success:function(response){
                //console.log(response['code'], response.code);
                if(response['code'] == 200){
                    $('#tradein-iframe').attr('src', '/' + response['filename']);
                    $('#label-trade-in-modal').modal('show');
                }
            },
            // error:function(response){
            //     alert(response.responseText);
            // }
        });
    }

</script>