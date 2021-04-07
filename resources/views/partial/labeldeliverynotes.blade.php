{{-- onclick="print('{{$tradein->id}}')" --}}

<div class="btn-purple sale-detail-btn large cursor-pointer" data-toggle="modal" data-target="#labelDeliveryModal">
    <p>{!!$btn_text!!}</p> 
    <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White.svg')}}">
</div>

<div class="modal fade" id="labelDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="labelDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title bold-uppercase" id="labelDeliveryModalLabel">Complete the following steps</h5>
            <img class="cursor-pointer" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
            {{-- <button type="button" class="close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
        </div>
        <div class="modal-body">
            <div class="steps-container-row">
                <div class="single-step-column">
                    <div class="column-item">
                        <img class="step-image" src="{{asset('/customer_page_images/body/delivery_note.svg')}}">
                    </div>
                </div>
                <div class="single-step-column">
                    <div class="column-item">
                        <img class="step-image" src="{{asset('/customer_page_images/body/packaging_posting.svg')}}">
                    </div>
                </div>
                <div class="single-step-column">
                    <div class="single-step-row">
                        <img class="step-image" src="{{asset('/customer_page_images/body/postage_label.svg')}}">
                    </div>
                    <div class="single-step-row">
                        <img class="step-image" src="{{asset('/customer_page_images/body/delivery_address_label.svg')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<script></script>