@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Receive Trade-In</p>
            </div>
        </div>
        <div class="portal-search-form-container">
            
            <div class="d-flex flex-wrap">
            @foreach($tradeins as $tradein)
                <a role="button" data-toggle="modal" data-target="#tradein-{{$tradein->id}}" class="p-3 ml-0 mr-0">
                    <div class="d-flex flex-column shadow bg-white rounded ml-5 mr-5 p-3">
                        <div class="" style="width:200px;">Product name: {{$tradein->getProductName($tradein->product_id)}}</div>
                        <div class="" style="width:200px;">Customer grade: {{$tradein->customer_grade}}</div>
                        <div class="" style="width:200px;">GB Size: {{$tradein->getDeviceMemory()}}</div>
                        <div class="" style="width:200px;">Price: £{{$tradein->order_price}}</div>
                    </div>
                </a>
            @endforeach
            </div>

        </div>

    </div>

    <div id="receiving-modal-container">
    @foreach($tradeins as $tradein)

        <div id="tradein-{{$tradein->id}}" class="receiving-modal modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proccess Tradein: {{$tradein->barcode}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #000">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-{{$tradein->id}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="tradeinid" value="{{$tradein->id}}">
                        
                        <div id="question-one-{{$tradein->id}}" class="question-one">
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device present?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">GB Size: {{$tradein->getDeviceMemory()}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="missing-yes" class="mx-0 my-3">Device is present.</label><input id="missing-yes-{{$tradein->id}}" class="select-input-fixed" type="radio" name="missing" value="present" data-value="{{$tradein->id}}"></div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="missing-no" class="mx-0 my-3">Device is not present</label><input id="missing-no-{{$tradein->id}}" class="select-input-fixed" type="radio" name="missing" value="missing" data-value="{{$tradein->id}}"></div>
                                </div>
                                <div class="d-flex w-100 hidden" id="missing_image_div_{{$tradein->id}}">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Image proof that device is missing</p></div>
                                    <div class="d-flex w-50 border p-3"><p><input type="file" id="missing_image_{{$tradein->id}}" name="missing_image" accept="image/x-png,image/gif,image/jpeg"></p></div>
                                </div>
                            </div>

                            <div class="w-100 d-flex justify-content-end px-3 my-3">
                                <button type="button" onclick="changeQuestion(2, 1, {{$tradein->id}})" id="question-one-next-button-{{$tradein->id}}" class="btn btn-primary" disabled>Next</button>
                            </div>
                            
                        </div>
                        <div id="question-two-{{$tradein->id}}" class="question-two">
                            @if($tradein->getCategoryId($tradein->product_id) > 1 && is_null($tradein->customer_network))
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device Serial number visible?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">GB Size: {{$tradein->getDeviceMemory()}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="visible_serial_yes" class="mx-0 my-3">Yes.</label><input id="visible_serial_yes" type="radio" class="select-input-fixed" name="visible_serial" value="yes" data-value="{{$tradein->id}}"></div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="visible_serial_no" class="mx-0 my-3">No.</label><input id="visible_serial_no_{{$tradein->id}}" type="radio" class="select-input-fixed" name="visible_serial" value="no" data-value="{{$tradein->id}}"></div>
                                </div>
                            </div>
                            <div class="w-100 d-flex justify-content-between px-3 my-3">
                                <button type="button" onclick="changeQuestion(1, 2, {{$tradein->id}})" class="btn btn-primary">Back</button>
                                <button type="button" onclick="changeQuestion(3, 2, {{$tradein->id}})" id="question-two-next-button-{{$tradein->id}}" class="btn btn-primary" disabled>Next</button>
                            </div>
                            @else
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device IMEI number visible?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">GB Size: {{$tradein->getDeviceMemory()}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="visible_imei_yes" class="mx-0 my-3">Yes.</label><input id="visible_imei_yes" type="radio" class="select-input-fixed" name="visible_imei" value="yes" data-value="{{$tradein->id}}"></div>
                                    <div class="d-flex flex-column justify-content-center align-items-center w-25 border p-3"><label for="visible_imei_no" class="mx-0 my-3">No.</label><input id="visible_imei_no_{{$tradein->id}}" type="radio" class="select-input-fixed" name="visible_imei" value="no" data-value="{{$tradein->id}}"></div>
                                </div>
                            </div>
                            <div class="w-100 d-flex justify-content-between px-3 my-3">
                                <button type="button" onclick="changeQuestion(1, 2, {{$tradein->id}})" class="btn btn-primary">Back</button>
                                <button type="button" onclick="changeQuestion(3, 2, {{$tradein->id}})" id="question-two-next-button-{{$tradein->id}}" class="btn btn-primary" disabled>Next</button>
                            </div>
                            @endif

                        </div>
                        <div id="question-three-{{$tradein->id}}" class="question-three">
                            @if($tradein->getCategoryId($tradein->product_id) > 1 && is_null($tradein->customer_network))
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Enter device serial number:</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">GB Size: {{$tradein->getDeviceMemory()}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>
                                    
                                    <div class="d-flex w-50 border p-3">
                                        <input id="serial_number" class="serial_number" type="text" name="serial_number" title="15 characters required">
                                    </div>
                                </div>
                                <div class="w-100 d-flex justify-content-between px-3 my-3">
                                    <button type="button" onclick="changeQuestion(2, 3, {{$tradein->id}})" class="btn btn-primary">Back</button>
                                    <button id="serial_submit" type="submit" onclick="javascript: form.action='/portal/testing/receive/receivingresults'"  class="btn btn-primary serial_submit" disabled>Submit</button>
                                </div>
                            </div>
                            @else
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Please enter IMEI number</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">GB Size: {{$tradein->getDeviceMemory()}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>
                                    <div class="d-flex flex-column w-50 border p-3">
                                        <input id="imei_number_{{$tradein->id}}" class="imei_number" size="15" type="number" name="imei_number" title="15 characters required">
                                        @if(Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{Session::get('error')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="w-100 d-flex justify-content-between px-3 my-3">
                                <button type="button" onclick="changeQuestion(2, 3, {{$tradein->id}})" class="btn btn-primary">Back</button>
                                <button id="imei_submit" onclick="checkImeiNumber({{$tradein->id}})" type="button" class="btn btn-primary imei_submit" disabled>Submit</button>
                            </div>
                            @endif

                        </div>
                        <div id="result-page-{{$tradein->id}}" class="question-four">
                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Status</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$tradein->getProductName()}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->customer_grade}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$tradein->customerName()}}</p><br>
                                    </div>

                                    <div class="d-flex w-50 border p-3" id="receiving-result-{{$tradein->id}}">
                                    
                                        <p></p>

                                    </div>
                                </div>
                            </div>
                            <div class="w-100 d-flex justify-content-between px-3 my-3">
                                <button type="button" onclick="changeQuestion(undefined, 4, {{$tradein->id}})" class="btn btn-primary">Back</button>
                                <div class="w-50 d-flex justify-content-between">
                                    <button type="submit" data-id="{{$tradein->id}}" onclick="javascript: form.action='/portal/testing/receive/toquarantineblacklisted'" class="send-to-quarantine btn btn-primary">Send to quarantine</button>
                                    <button type="submit" class="send-to-testing btn btn-primary" onclick="javascript: form.action='/portal/testing/receive/receivingresults'" style="margin-left:auto; margin-right:0;">Send to testing</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    
    @endforeach

    </div>
    
@endsection