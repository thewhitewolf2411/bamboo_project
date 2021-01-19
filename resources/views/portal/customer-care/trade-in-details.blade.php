<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
                {{-- <div class="portal-content-container">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-in Summary</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Trade-In ID:</p>
                                    <p>Trade-In Barcode:</p>
                                    <p>Payment Address</p>
                                    <p>Website/Store:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$barcode}}</p>
                                    <p>{{$tradeins[0]->barcode_original}}</p>
                                    <p></p>
                                    <p>Bamboo Recycle (Website)</p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Trade-In Placed:</p>
                                    <p>Collection Address</p>
                                    <p>Source:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$tradeins[0]->created_at->format('Y/m/d')}}</p>
                                    <p></p>
                                    <p>Website</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Payment and Delivery Details</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Payment Method:</p>
                                    <p>Delivery Method:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Total/Outstanding Payment Cost: </p>
                                    <p>Total/Outstanding Delivery Cost: </p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Free</p>
                                    <p>Free</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Customer Details</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Name: </p>
                                    <p>Contact No.:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$user->first_name}} {{$user->last_name}}</p>
                                    <p>{{$user->contact_number}}</p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Company Name: </p>
                                    <p>Email Address: </p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>none</p>
                                    <p>none</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}

                <div class="table">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-in Summary</p>
                        </div>
                    </div>
                    <table class="portal-table">
                        <tbody>
                            <tr>
                                <td>Trade-In ID: {{$barcode}}</td>
                                <td>Trade-in Placed: {{$tradeins[0]->created_at->format('Y/m/d')}}</td>
                            </tr>
                            <tr>
                                <td>Trade-in Barcode: {{$tradeins[0]->barcode_original}}</td>
                                <td>Collection Address: </td>
                            </tr>
                            <tr>
                                <th>Billing address: </th>
                                <td style="border: none;"></td>
                            </tr>
                        </tbody>
                      </table>
                </div>

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
                                <td>Shipping Address: </td>
                                <td>Postcode:</td>
                            </tr>
                            <tr>
                                <td>Contact No: {{$tradeins[0]->customer()->contact_number}}</td>
                                <td>Email Address: {{$tradeins[0]->customer()->email}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                      </table>
                </div>

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
                                        <input class="lock-status-checkbox" type="checkbox" @if($tradeins[0]->isGoogleLocked()) checked @endif  onclick="return false;"/>
                                        <label class="radio-lock-status-label">Yes</label>
                                    </div>
                                    <div class="radio-lock-status">
                                        <input class="lock-status-checkbox" type="checkbox" @if(!$tradeins[0]->isGoogleLocked()) checked @endif onclick="return false;"/>
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


                {{-- <div class="portal-title">
                    <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-In Products</p>
                </div>

                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Trade-In Product ID</div></td>
                        <td><div class="table-element">Name</div></td>
                        <td><div class="table-element">Customer Status</div></td>
                    </tr>
                    @foreach($tradeins as $tradein)
                    <tr>
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                        <td><div class="table-element">{{$tradein->product_state}}</div></td>
                    </tr>
                    @endforeach
                </table> --}}

                <div class="portal-title">
                    <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Device History</p>
                </div>

                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Date Placed</div></td>
                        <td><div class="table-element">Trade-In ID</div></td>
                        <td><div class="table-element">Trade-In Barcode</div></td>
                        <td><div class="table-element">Product</div></td>
                        <td><div class="table-element">User</div></td>
                        <td><div class="table-element">Customer Status</div></td>
                        <td><div class="table-element">Bamboo Status</div></td>
                        <td><div class="table-element">Customer Grade</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Stock Location</div></td>
                        <td><div class="table-element">Cheque Number</div></td>
                    </tr>
                    @foreach($audits as $audit)
                    <tr>
                        <td><div class="table-element">{{$audit->created_at->format('d/m/Y H:i')}}</div></td>
                        <td><div class="table-element">{{$audit->tradein_barcode}}</div></td>
                        <td><div class="table-element">{{$audit->tradein_barcode_original}}</div></td>
                        <td><div class="table-element">{{$audit->getProduct()}}</div></td>
                        <td><div class="table-element">{{$audit->getUser()}}</div></td>
                        <td><div class="table-element">{{$audit->customer_status}}</div></td>
                        <td><div class="table-element">{{$audit->bamboo_status}}</div></td>
                        <td><div class="table-element">{{$audit->customer_grade}}</div></td>
                        <td><div class="table-element">{{$audit->bamboo_grade}}</div></td>
                        <td><div class="table-element">{{$audit->value}}</div></td>
                        <td><div class="table-element">{{$audit->stock_location}}</div></td>
                        <td><div class="table-element">{{$audit->cheque_number}}</div></td>
                    </tr>
                    @endforeach
                </table>

                <br>

                @if($testingfaults !== null)
                <div class="portal-table-container">
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
                </div>
                @endif
            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
