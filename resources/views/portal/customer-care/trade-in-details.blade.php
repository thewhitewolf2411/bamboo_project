<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


    <!-- Sortable -->
    <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Trade-in ID #{{$barcode}}</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>View Trade-in #{{$barcode}}</p>
                    </div>
                </div>


                <!-- TRADE-IN SUMMARY -->
                <div class="table">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-in Summary</p>
                        </div>
                    </div>
                    <table class="portal-table">
                        <tbody>
                            <tr>
                                <td>Trade-In ID: {{$tradeins[0]->barcode_original}} </td>
                                <td>Trade-in Placed: {{$tradeins[0]->created_at->format('Y/m/d')}}</td>
                            </tr>
                            <tr>
                                <td>Trade-in Barcode: {{$barcode}}</td>
                                <td>Collection Address: {!!$user->collectionAddress()!!}</td>
                            </tr>
                            <tr>
                                <td>Billing address: {!!$user->billingAddress()!!}</td>
                                <td style="border: none;"></td>
                            </tr>
                        </tbody>
                      </table>
                </div>


                <!-- PAYMENT + DELIVERY DETAILS -->
                <div class="table">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Payment + Delivery details</p>
                        </div>
                    </div>
                    <table class="portal-table">
                        <tbody>
                            <tr>
                                <td>Payment Method: </td>
                                <td>Total Outstanding Payment Cost: </td>
                            </tr>
                            <tr>
                                <td>Delivery Method: </td>
                                <td>Tracking Reference: </td>
                            </tr>
                        </tbody>
                      </table>
                </div>




                <!-- CUSTOMER DETAILS -->
                <div class="table">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Customer Details</p>
                        </div>
                    </div>
                    <table class="portal-table">
                        <tbody>
                            <tr>
                                <td>Name: {{$tradeins[0]->customer()->fullName()}}</td>
                                <td>Shipping Address: {!!$user->shippingAddress()!!}</td>
                                <td>Postcode: {!!$user->postCode()!!}</td>
                            </tr>
                            <tr>
                                <td>Contact No: {{$tradeins[0]->customer()->contact_number}}</td>
                                <td>Email Address: {{$tradeins[0]->customer()->email}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                      </table>
                </div>




                <!-- ORDER DETAILS -->
                <div class="table">

                    <div class="portal-title">
                        <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Order Details</p>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-In ID</div></td>
                            <td><div class="table-element">Device Name</div></td>
                            <td><div class="table-element">Customer Status</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->getCustomerStatus()}}</div></td>
                        </tr>
                        @endforeach
                    </table>

                </div>




                <!-- DEVICE DETAILS -->
                <div class="table">
                    <div class="portal-title">
                        <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Device Details</p>
                    </div>

                    @foreach($tradeins as $tradein)
                        <table class="portal-table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>Make/Model:</strong></div> 
                                            <div class="ml-auto">{{$tradein->getProductName($tradein->product_id)}}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>GB:</strong></div> 
                                            <div class="ml-auto">@if(isset($tradein->correct_memory)) {!!$tradein->correct_memory!!} @else {!!$tradein->customer_memory!!} @endif</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>Colour:</strong></div>
                                            <div class="ml-auto">{!!$tradein->product_colour!!}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>Customer Grade:</strong></div>
                                            <div class="ml-auto">{{$tradein->customer_grade}}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>Bamboo Grade:</strong></div> 
                                            <div class="ml-auto">@if(isset($tradein->bamboo_grade)) {!!$tradein->bamboo_grade!!} @else Device not tested. @endif</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-element">
                                            <div class="mr-auto"><strong>Offer Value:</strong></div> 
                                            <div class="ml-auto">£ {{$tradein->order_price}}</div>
                                        </div>
                                    </td>
                                </tr>

                                @if($testingfaults !== null)
                                    {{-- <div class="portal-table-container">
                                        <div class="portal-title">
                                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Testing fault details</p>
                                        </div>

                                        <table class="portal-table sortable" id="categories-table">
                                            <tr>
                                                <td><div class="table-element">Trade-In Product ID</div></td>
                                                <td><div class="table-element">Audio test</div></td>
                                                <td><div class="table-element">Front Microphone</div></td>
                                                <td><div class="table-element">Headset test</div></td>
                                                <td><div class="table-element">Loud speaker test</div></td>
                                                <td><div class="table-element">Microphone playback test</div></td>
                                                <td><div class="table-element">Button test</div></td>
                                                <td><div class="table-element">Sensor test</div></td>
                                            </tr>

                                            <tr>
                                                <td><div class="table-element">{{$tradeins[0]->barcode}}</div></td>
                                                <td><div class="table-element">@if($testingfaults->audio_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->front_microphone) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->headset_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->loud_speaker_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->microphone_playback_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->buttons_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->sensor_test) Failed @endif</div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="table-element">Camera test</div></td>
                                                <td><div class="table-element">Glass condition</div></td>
                                                <td><div class="table-element">Vibration</div></td>
                                                <td><div class="table-element">Original colour</div></td>
                                                <td><div class="table-element">Battery health</div></td>
                                                <td><div class="table-element">NFC</div></td>
                                                <td><div class="table-element">No power</div></td>
                                                <td><div class="table-element">Fake or missing parts</div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="table-element">@if($testingfaults->camera_test) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->glass_condition) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->vibration) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->original_colour) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->battery_health) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->nfc) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->no_power) Failed @endif</div></td>
                                                <td><div class="table-element">@if($testingfaults->fake_missing_parts) Failed @endif</div></td>
                                            </tr>
                                        </table>
                                    </div> --}}

                                    @if($testingfaults->audio_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Audio test</div>
                                            </div>
                                        </td>
                                    @endif
                                    
                                    @if($testingfaults->front_microphone !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Front microphone</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->headset_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Headset test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->loud_speaker_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Loud speaker test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->microphone_playback_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Microphone playback test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->buttons_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Buttons test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->sensor_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Sensor test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->camera_test !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Camera test</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->glass_condition !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Glass condition</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->vibration !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Vibration</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->original_colour !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Original colour</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->battery_health !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Battery health</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->nfc !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">NFC</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->no_power !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">No power</div>
                                            </div>
                                        </td>
                                    @endif

                                    @if($testingfaults->fake_missing_parts !== null)
                                        <td>
                                            <div class="table-element">
                                                <div class="mr-auto"><strong>Functional Fail:</strong></div>
                                                <div class="ml-auto">Fake missing parts</div>
                                            </div>
                                        </td>
                                    @endif

                                @endif

                            </tbody>
                        </table>
                        <br>
                    @endforeach
                </div>




                <!-- JOB STATUS -->
                <div class="table">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Job Status</p>
                        </div>
                    </div>
                    <div class="job-status-container">
                        <div class="col w-25">
                            <div class="job-status">
                                Customer Status: {{$tradeins[0]->getCustomerStatus()}}<br>
                            </div>
                            <div class="job-status">
                                Bamboo Status: {{$tradeins[0]->getBambooStatus()}}
                            </div>
                        </div>
                        <div class="col w-75">

                            <div class="lock-status-row">
                                <label class="lock-status-title">Google Lock/FMIP:</label>
                                @if($tradeins[0]->isGoogleLocked() !== null)
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if($tradeins[0]->isGoogleLocked() || $tradeins[0]->isFimpLocked()) checked @endif  onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if(!($tradeins[0]->isGoogleLocked() || $tradeins[0]->isFimpLocked())) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @else
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @endif
                            </div>

                            <div class="lock-status-row">
                                <label class="lock-status-title">Pin Locked:</label>
                                @if($tradeins[0]->isPinLocked() !== null)
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if($tradeins[0]->isPinLocked()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if(!$tradeins[0]->isPinLocked()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @else
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @endif
                            </div>

                            <div class="lock-status-row">
                                <label class="lock-status-title">Blacklisted:</label>
                                @if($tradeins[0]->isBlacklisted() !== null)
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if($tradeins[0]->isBlacklisted()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if(!$tradeins[0]->isBlacklisted()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @else
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @endif
                            </div>

                            <div class="lock-status-row">
                                <label class="lock-status-title">SIM Locked:</label>
                                @if($tradeins[0]->isSIMLocked() !== null)
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if($tradeins[0]->isSIMLocked()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if(!$tradeins[0]->isSIMLocked()) checked @endif onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @else
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" onclick="return false;"/>
                                        <label class="radio-lock-status-label">No</label>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>




                <!-- DEVICE HISTORY -->
                <div class="table">
                    <div class="portal-title">
                        <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Device History</p>
                    </div>
                    @foreach($tradeins as $tradein)

                        <table class="portal-table sortable" id="categories-table">
                            <tr>
                                <td><div class="table-element">Date Placed</div></td>
                                <td><div class="table-element text-center">Trade-In ID</div></td>
                                <td><div class="table-element text-center">Trade-In Barcode</div></td>
                                <td><div class="table-element">Product</div></td>
                                <td><div class="table-element">User</div></td>
                                <td><div class="table-element text-center">Customer Status</div></td>
                                <td><div class="table-element text-center">Bamboo Status</div></td>
                                <td><div class="table-element text-center">Customer Grade</div></td>
                                <td><div class="table-element text-center">Bamboo Grade</div></td>
                                <td><div class="table-element">Value</div></td>
                                <td><div class="table-element text-center">Stock Location</div></td>
                                <td><div class="table-element">Cheque Number</div></td>
                                <td><div class="table-element">Pattern/PIN</div></td>
                                <td></td>
                            </tr>
                            @foreach($tradein->audit_records as $audit)
                            <tr>
                                <td><div class="table-element">{{$audit->created_at->format('d/m/Y H:i')}}</div></td>
                                <td><div class="table-element text-center">{{$audit->tradein_barcode_original}}</div></td>
                                <td><div class="table-element text-center">{{$audit->tradein_barcode}}</div></td>
                                <td><div class="table-element text-center">{{$audit->getProduct()}}</div></td>
                                <td><div class="table-element text-center">{{$audit->getUser()}}</div></td>
                                <td><div class="table-element text-center">{{$audit->customer_status}}</div></td>
                                <td><div class="table-element text-center">{{$audit->bamboo_status}}</div></td>
                                <td><div class="table-element text-center">{{$audit->customer_grade}}</div></td>
                                <td><div class="table-element text-center">{{$audit->bamboo_grade}}</div></td>
                                <td><div class="table-element text-center">£ {{$audit->value}}</div></td>
                                <td><div class="table-element text-center">{{$audit->stock_location}}</div></td>
                                <td><div class="table-element">{{$audit->cheque_number}}</div></td>
                                <td><div class="table-element">{{$audit->pin_pattern_number}}</div></td>
                                <td @if(Auth::user()->admin()) @if($audit->notes_count > 0) style="background: #f1f15f" @endif @endif>
                                    <div class="add-note-button" @if(Auth::user()->admin()) data-toggle="modal" data-target="#noteModal" onclick="openNoteModal({{$audit}})" @endif>&nbsp;+&nbsp;</div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <br>
                        <br>
                    @endforeach
                </div>




                <!-- missing image -->
                @if($tradeins[0]->missing_image)
                    <h5 class="text-center">Missing image:</h5>
                    <img src="{{$tradeins[0]->getMissingImage()}}" id="missing-img" class="img-thumbnail text-center missing-img"
                    style="display: block;position: relative;margin-right: auto;margin-left: auto; max-width: 500px;">

                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">              
                            <div class="modal-body p-0">
                                <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> -->
                              <img src="" class="imagepreview" style="width: 100%;" >
                            </div>
                          </div>
                        </div>
                      </div>
                @endif

            </div>
        </div>
    </main>

    <!-- notes modal -->
    <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Audit notes</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span style="color: black;" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-2 text-center">

                <div id="no-notes-info" class="mb-2 hidden">
                    No notes for current audit.
                </div>

                <div id="audit_notes_list" class="hidden"></div>

                <div id="add-audit-note" class="btn btn-outline-primary" onclick="showAddNote()">Add note</div>

                <div id="audit-note" class="hidden">
                    <div class="note-bold-title">Note:</div>
                    <textarea id="note_text" class="m-2"></textarea>
                    <div id="note_action_buttons">
                        <div id="back_to_list" class="btn btn-dark w-25 ml-auto mr-auto mt-2 hidden" onclick="backToList()">Back</div>
                        <div id="save_note" class="btn btn-green w-25 ml-auto mr-auto mt-2" onclick="saveNote()">Save</div>
                        <div id="update_note" class="btn btn-green w-25 ml-auto mr-auto mt-2 hidden" onclick="updateNote()">Save</div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
    </div>

</body>

<script>

    $(function() {
        $('.missing-img').on('click', function() {
            $('.imagepreview').attr('src', $('#missing-img').attr('src'));
            $('#imagemodal').modal('show');   
        });		
    });

    var selected_audit = {};
    var selected_note = {};
    var CAN_DELETE_NOTE = "{{Auth::user()->canDeleteNotes()}}";

    var add_button = document.getElementById("add-audit-note");
    var note = document.getElementById("audit-note");
    var note_info = document.getElementById("no-notes-info");
    var note_text = document.getElementById("note_text");
    var notes_list = document.getElementById("audit_notes_list");

    var back_to_list_button = document.getElementById("back_to_list");
    var update_note_button = document.getElementById("update_note");
    var save_note_button = document.getElementById("save_note");

    function openNoteModal(audit){
        selected_audit = {};
        selected_audit = audit;
        // load notes
        notes_list.innerHTML = '';

        if(selected_audit.notes.length < 1){
            // no notes, show add only
            note_info.classList.remove('hidden');
        } else {
            // show notes, hide info
            for (const [k, object] of Object.entries(selected_audit.notes)) {
                
                var note_item = document.createElement("div");
                note_item.classList.add('note_item');

                var note_text = document.createElement("p");
                note_text.classList.add('note_item_text');
                note_text.innerHTML = object.user + ' [' + object.date + "] - <i style='color: black;'>" + object.note + "</i>";

                var open_button = document.createElement("div");
                open_button.classList.add('btn');
                open_button.classList.add('btn-outline-success');
                open_button.innerHTML = 'View';
                open_button.onclick = function() {showNote(object)};

                var delete_button = document.createElement("div");
                delete_button.classList.add('btn');
                delete_button.classList.add('btn-outline-danger');
                delete_button.classList.add('mr-1');
                delete_button.innerHTML = 'Delete';
                delete_button.onclick = function() {deleteNote(object)};

                note_item.appendChild(note_text);
                if(CAN_DELETE_NOTE === 'true'){
                    note_item.appendChild(delete_button);
                }
                note_item.appendChild(open_button);
                notes_list.appendChild(note_item);
            }

            note_info.classList.add('hidden');
            notes_list.classList.remove('hidden');
        }
    }

    function showNote(note_object){
        selected_note = note_object;
        note_text.value = note_object.note;
        notes_list.classList.add('hidden');
        add_button.classList.add('hidden');
        note_info.classList.add('hidden');
        back_to_list_button.classList.remove('hidden');
        note.classList.remove('hidden');
        update_note_button.classList.remove('hidden');
        save_note_button.classList.add('hidden');
    }

    function showAddNote(){
        notes_list.classList.add('hidden');
        add_button.classList.add('hidden');
        note_info.classList.add('hidden');
        note.classList.remove('hidden');
        back_to_list_button.classList.remove('hidden');
    }

    function backToList(){
        selected_note = {};
        notes_list.classList.remove('hidden');
        add_button.classList.remove('hidden');
        note_info.classList.add('hidden');
        back_to_list_button.classList.add('hidden');
        note.classList.add('hidden');
    }

    function deleteNote(note_object){
        alert('delete');
    }

    function updateNote(){
        alert(selected_note);
    }

    function saveNote(){
        let note = note_text.value;
        if(note.length < 5){
            alert('Please enter miminum 5 characters.');
            return;
        }
        $.ajax({
            type: "POST",
            url: "{{route('addAuditNote')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id: selected_audit.id, note: note},
            success: function(response) {
                if(response == 200){
                    // console.log(response);
                    alert('Note added.');
                    // reload notes
                    window.location.reload();
                }
            }
        });
    }

    function updateNote(){
        let note = note_text.value;
        if(note.length < 5){
            alert('Please enter miminum 5 characters.');
            return;
        }
        $.ajax({
            type: "POST",
            url: "{{route('updateAuditNote')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id: selected_note.id, note: note},
            success: function(response) {
                if(response == 200){
                    // console.log(response);
                    alert('Note updated.');
                    window.location.reload();
                }
            }
        });
    }

    function deleteNote(note){
        $.ajax({
            type: "POST",
            url: "{{route('deleteAuditNote')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id: note.id},
            success: function(response) {
                if(response == 200){
                    // console.log(response);
                    alert('Note deleted.');
                    window.location.reload();
                }
            }
        });
    }

</script>


</html>
