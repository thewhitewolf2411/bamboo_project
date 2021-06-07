{{-- onclick="print('{{$tradein->id}}')" --}}

<div class="btn-purple sale-detail-btn large cursor-pointer" data-toggle="modal" data-target="#labelDeliveryModal">
    <p>{!!$btn_text!!}</p> 
    <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White.svg')}}">
</div>

<div class="modal fade" id="labelDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="labelDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content p-4">
        <div class="modal-header">
            <h5 class="modal-title bold-uppercase" id="labelDeliveryModalLabel">Complete the following steps</h5>
            <img class="cursor-pointer close-modal-labeldelivery" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
            {{-- <button type="button" class="close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
        </div>
        <div class="modal-body mt-3">
            <div class="steps-container-row">
                <div class="single-step-column">
                    <p class="step-title-info">Step 1</p>
                    <div class="column-item column-link" onclick="printDeliveryNote({!!$tradein->id!!})">
                        <img class="step-image" src="{{asset('/customer_page_images/body/delivery_note.svg')}}">
                        <p class="step-info-bold">Delivery Note</p>
                    </div>
                </div>
                <div class="single-step-column">
                    <p class="step-title-info">Step 2</p>
                    <div class="column-item column-link" onclick="printPackagingInstructions({!!$tradein->id!!})">
                        <img class="step-image" src="{{asset('/customer_page_images/body/packaging_posting.svg')}}">
                        <p class="step-info-bold">Packaging & Posting instructions</p>
                        <div id="packaging-label-loader" class="hidden mr-auto">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
                <div class="single-step-column">
                    <p class="step-title-info">Step 3</p>

                    <a class="single-step-row link m-0" href="https://www.royalmail.com/track-my-return/create/4356" target="_blank">
                        <img class="step-image row" src="{{asset('/customer_page_images/body/postage_label.svg')}}">
                        <p class="step-info-bold row">Print FREE Postage Label</p>
                    </a>

                    <div class="step-or">
                        <div class="grey-step-line"></div><p>or</p><div class="grey-step-line"></div>
                    </div>

                    <div class="single-step-row link" onclick="printSpecialLabel({!!$tradein->id!!})">
                        <img class="step-image row" src="{{asset('/customer_page_images/body/delivery_address_label.svg')}}">
                        <p class="step-info-bold row">Print Special Delivery Return Address Label</p>
                        <div id="special-label-loader" class="hidden mr-auto">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div id="labels-print-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Print label</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="color: black;" aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <iframe id="labels-iframe" class="w-100 vh-100"></iframe>
        </div>
        </div>
    </div>
</div>

<script>
    // function printFreeLabel(id){
    //     $('#free-label-loader').removeClass('hidden');

    //     $.ajax({
    //         url: "/printdeliverylabel/free",
    //         method:"POST",
    //             data:{
    //                 _token: "{!! csrf_token() !!}",
    //                 tradein: id,
    //             },
    //         success:function(response){
    //             if(response['code'] == 200){
    //                 $('#free-label-loader').addClass('hidden');
    //                 $('#labelDeliveryModal').modal('hide');

    //                 $('#labels-iframe').attr('src', '/' + response['filename']);
    //                 $('#labels-print-modal').modal('show');
    //             }
    //         },
    //         // error:function(response){
    //         //     alert(response.responseText);
    //         // }
    //     });
    
    // }

    function printDeliveryNote(id){

        $.ajax({
            url: "/printorderlabel",
            method:"GET",
                data:{
                    tradein: id,
                },
            success:function(response){
                $('#special-label-loader').addClass('hidden');
                $('#labelDeliveryModal').modal('hide');

                $('#labels-iframe').attr('src', '/storage/pdf/' + response['filename']);
                $('#labels-print-modal').modal('show');
            },
            error:function(response){
                alert(response.responseText);
            }
        });
    }

    function printPackagingInstructions(){
        $('#packaging-label-loader').removeClass('hidden');
        $('#packaging-label-loader').addClass('hidden');
        $('#labelDeliveryModal').modal('hide');

        $('#labels-iframe').attr('src', '/Bamboo_4pp_InfoLeaflet_PrintYourOwn_PlannedUp.pdf');
        $('#labels-print-modal').modal('show');
        
        // $.ajax({
        //     url: "/printdeliverylabel/instructions",
        //     method:"POST",
        //         data:{
        //             _token: "{!! csrf_token() !!}",
        //         },
        //     success:function(response){
        //         if(response['code'] == 200){
        //             $('#packaging-label-loader').addClass('hidden');
        //             $('#labelDeliveryModal').modal('hide');

        //             $('#labels-iframe').attr('src', '/' + response['filename']);
        //             $('#labels-print-modal').modal('show');
        //         }
        //     },
        //     error:function(response){
        //         alert(response.responseText);
        //     }
        // });
    }

    function printSpecialLabel(id){
        $('#special-label-loader').removeClass('hidden');

        $.ajax({
            url: "/printdeliverylabel/special",
            method:"POST",
                data:{
                    _token: "{!! csrf_token() !!}",
                    tradein: id,
                },
            success:function(response){
                if(response['code'] == 200){
                    $('#special-label-loader').addClass('hidden');
                    $('#labelDeliveryModal').modal('hide');

                    $('#labels-iframe').attr('src', '/' + response['filename']);
                    $('#labels-print-modal').modal('show');
                }
            },
            // error:function(response){
            //     alert(response.responseText);
            // }
        });
    }
</script>