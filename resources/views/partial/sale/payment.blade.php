<div class="customer-orders customer-buying py-3">

    @if($tradein->paymentFailed())
        <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
            <div class="emoji-col">
                <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                <p class="emoji-text">Uh-oh!</p>
            </div>
            <p class="emoji-info-text">
                We have encountered an issue whilst trying to submit your
                payment. Please ensure your payment details are correct.
            </p>
        </div>
    @endif

    @if($tradein->job_state === '25')
        <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
            <div class="emoji-col">
                <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                <p class="emoji-text">Woohoo!</p>
            </div>
            <p class="emoji-info-text">
                Your device passed our checks with flying colours.
                Your payment will now be submitted.
            </p>
        </div>
    @endif

    @if(Auth::user()->hasPaymentDetails())
        <div class="payment-item-info">
            <div class="col-3">
                <p class="m-0">Name on account</p>
                <p style="font-size: 20px;">{!!Auth::user()->accountName()!!}</p>
            </div>
            <div class="col-2">
                <p class="m-0">Account number</p>
                <p style="font-size: 20px;">{!!Auth::user()->accountNumber()!!}</p>
            </div>
            <div class="col-2">
                <p class="m-0">Sort Code</p>
                <p style="font-size: 20px;">{!!Auth::user()->sortCode()!!}</p>
            </div>
            @if($tradein->bamboo_price !== null)
                <div class="col-2">
                    <p class="payment-price-label">Agreed Price</p>
                    <p class="payment-agreed-price">£{!!$tradein->bamboo_price!!}</p>
                </div>
            @endif
            <button type="button" class="btn btn-purple payment-details-btn mt-auto mb-auto " style="color: white;" data-toggle="modal" data-target="#accountDetils">
                Re-enter details <img class="payment-pen-icon" src="{{asset('/images/pen.png')}}">
            </button>
        </div>
    @else
        <div class="row justify-content-sm-around">
            <div class="p-1">No payment information added. Please add your payment details.</div>

            <button type="button" class="btn btn-purple" style="color: white;" data-toggle="modal" data-target="#accountDetils">
                Enter details
            </button>
        </div>
    @endif

    @if(Session::has('account_fails'))
        <div class="row justify-content-center">
            <div class="alert alert-danger my-5" role="alert">
                @foreach(Session::get('account_fails') as $message)
                    <li>{{$message}}</li>
                @endforeach
            </div>
        </div>
    @endif

    @if(Session::has('account_success'))
        <div class="row justify-content-center">
            <div class="alert alert-success my-5" role="alert">
                {!!Session::get('account_success')!!}
            </div>
        </div>
    @endif

</div>

<!-- Modal -->
<div class="modal fade" id="accountDetils" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">PAYMENT DETAILS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: black;">&times;</span>
                </button>
            </div>
            <form id="accountdetails" method="POST" action="/userprofile/accountdetails">
                @csrf
                <div class="modal-body p-4">
                        <div class="col w-50 m-auto">
                            <label for="account_name" style="font-size: 16px;">Name on Account</label>
                            <input type="text" name="account_name" class="form-control" required aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col w-50 m-auto">
                            <label for="account_name" style="font-size: 16px;">Account number</label>
                            <input type="number" name="account_number" class="form-control" required aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col w-50 m-auto">
                            <label for="account_name" style="font-size: 16px;">Sort code</label>
                            <div class="row m-0 justify-content-start">
                                <input type="number" name="sort_code_1" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                <p class="m-3">&mdash;</p>
                                <input type="number" name="sort_code_2" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                <p class="m-3">&mdash;</p>
                                <input type="number" name="sort_code_3" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" style="color: white;" class="btn btn-purple">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

