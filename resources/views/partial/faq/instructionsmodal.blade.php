@if($type === 'googleInstructions')
    @if(isset($page))
        <a role="button" class="answer-text link" data-toggle="modal" data-target="#{{$type}}Modal"><p class="infotext-sell-item bold hoverable">How to remove Google Lock</p></a>
    @else
        <p class="answer-text">It would be best if you can remove your device from your Google account before sending the device to us. 
            This is really quick and easy to do, please 
            <a role="button" class="answer-text link" data-toggle="modal" data-target="#{{$type}}Modal">click</a>
            for a simple guide…
        </p>
    @endif

    <div class="modal fade" id="{{$type}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header grades border-0">
                    <p class="grades-info-header-text">Android Account Removal Instructions</p>
                    <div class="close-grades-box">
                        <button type="button" class="close close-grades-modal-button" data-dismiss="modal" aria-label="Close">
                            <img class="close-grades-img" src="{{ url('/images/front-end-icons/close_modal_orange.svg') }}">
                        </button>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="d-flex flex-row">
                        <div class="toggle-instruction-section selected-instruction ml-1" id="androidWifiRemove" onclick="toggleGoogleInstructions(1)">
                            Remove Android lock with your Device (Wifi required)
                        </div>
                        <div class="toggle-instruction-section mr-1" id="androidRemotely" onclick="toggleGoogleInstructions(2)">
                            Remove Android lock from your Device (Remotely)
                        </div>
                    </div>

                    <div id="androidWifiCollapse">
                        <div class="instruction-section-description ml-1 mr-1 mb-1">
                            <div class="grade-desc-column">
                                <p class="grade-desc-item">1.	Power on your device</p>
                                <p class="grade-desc-item">2.	Select ‘Settings’ >’Accounts or User Accounts’</p>
                                <p class="grade-desc-item">3.	Select account type, ‘Google’</p>
                                <p class="grade-desc-item">4.	Press the 3 dots at top right corner of screen</p>
                                <p class="grade-desc-item">5.	Select ‘Remove Account’</p>
                                <p class="grade-desc-item">6.	Confirm by selecting ‘Remove Account’ again</p>
                                <p class="grade-desc-item">Please note that the general instructions to remove Android lock may vary slightly depending on your device model. </p>
                            </div>
                        </div>
                    </div>

                    <div id="androidRemotelyCollapse" class="hidden">
                        <div class="instruction-section-description ml-1 mr-1 mb-1">
                            <div class="grade-desc-column">
                                <p class="grade-desc-item">1.	Log into your Google Account</p>
                                <p class="grade-desc-item">2.	Go to the My Account Page (https://myaccount.google.com/)</p>
                                <p class="grade-desc-item">3.	Click on Device Activity and Notification</p>
                                <p class="grade-desc-item">4.	Under recently used devices click Review Devices</p>
                                <p class="grade-desc-item">5.	From the list find the lost or stolen phone or device and click “remove”</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleGoogleInstructions(id){
            switch (id) {
                case 1:
                    document.getElementById('androidWifiRemove').classList.add('selected-instruction');
                    document.getElementById('androidRemotely').classList.remove('selected-instruction');
                    document.getElementById('androidWifiCollapse').classList.remove('hidden');
                    document.getElementById('androidRemotelyCollapse').classList.add('hidden');
                    break;
                case 2:
                    document.getElementById('androidWifiRemove').classList.remove('selected-instruction');
                    document.getElementById('androidRemotely').classList.add('selected-instruction');
                    document.getElementById('androidWifiCollapse').classList.add('hidden');
                    document.getElementById('androidRemotelyCollapse').classList.remove('hidden');
                    break;
            
                default:
                    break;
            }
            console.log(id);
        }
    </script>
@endif




@if($type === 'appleInstructions')
    @if(isset($page))
        <a role="button" class="answer-text link" data-toggle="modal" data-target="#{{$type}}Modal"><p class="infotext-sell-item bold hoverable">How to remove Find My iPhone</p></a>
    @else
        <p class="answer-text">
            {{-- Remove your device from your iCloud account before sending the device to us. 
            This is really quick and easy to do, please  --}}
            It would be best if you can remove your device from your iCloud account before sending the device to us. This is really quick and easy to do, please
            <a role="button" class="answer-text link" data-toggle="modal" data-target="#{{$type}}Modal">click</a>
            for a simple guide…
        </p>
    @endif
    

    <div class="modal fade" id="{{$type}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header grades border-0">
                    <p class="grades-info-header-text">Removal of FMIP from Apple devices</p>
                    <div class="close-grades-box">
                        <button type="button" class="close close-grades-modal-button" data-dismiss="modal" aria-label="Close">
                            <img class="close-grades-img" src="{{ url('/images/front-end-icons/close_modal_orange.svg') }}">
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                        
                    <div class="d-flex flex-row">
                        <div class="toggle-instruction-section selected-instruction ml-1" id="appleWifiRemove" onclick="toggleAppleInstructions(1)">
                            Remove Find My iPhone/iCloud with your iPhone (Wifi required)
                        </div>
                        <div class="toggle-instruction-section ml-1" id="applePCRemove" onclick="toggleAppleInstructions(2)">
                            Remove Find My iPhone/iCloud using PC/laptop
                        </div>
                        <div class="toggle-instruction-section mr-1" id="appleWatchRemove" onclick="toggleAppleInstructions(3)">
                            Remove Find My iPhone/iCloud from your Apple Watch
                        </div>
                    </div>

                    <div id="appleWifiCollapse">
                        <div class="instruction-section-description ml-1 mr-1 mb-1">
                            <div class="grade-desc-column">
                                <p class="grade-desc-item">1.	Power on your device</p>
                                <p class="grade-desc-item">2.	Select ‘Settings’ >’Accounts or User Accounts’</p>
                                <p class="grade-desc-item">3.	Select account type, ‘Google’</p>
                                <p class="grade-desc-item">4.	Press the 3 dots at top right corner of screen</p>
                                <p class="grade-desc-item">5.	Select ‘Remove Account’</p>
                                <p class="grade-desc-item">6.	Confirm by selecting ‘Remove Account’ again</p>
                                <p class="grade-desc-item">Please note that the general instructions to remove Android lock may vary slightly depending on your device model. </p>
                            </div>
                        </div>
                    </div>

                    <div id="applePCCollapse" class="hidden">
                        <div class="instruction-section-description ml-1 mr-1 mb-1">
                            <div class="grade-desc-column">
                                <p class="grade-desc-item">1.	Log into your Google Account</p>
                                <p class="grade-desc-item">2.	Go to the My Account Page (https://myaccount.google.com/)</p>
                                <p class="grade-desc-item">3.	Click on Device Activity and Notification</p>
                                <p class="grade-desc-item">4.	Under recently used devices click Review Devices</p>
                                <p class="grade-desc-item">5.	From the list find the lost or stolen phone or device and click “remove”</p>
                            </div>
                        </div>
                    </div>

                    <div id="appleWatchCollapse" class="hidden">
                        <div class="instruction-section-description ml-1 mr-1 mb-1">
                            <div class="grade-desc-column">
                                <p class="grade-desc-item">1.	Keep your Apple Watch and iPhone close together. </p>
                                <p class="grade-desc-item">2.	Open the Watch app on your iPhone.</p>
                                <p class="grade-desc-item">3.	Tap the My Watch tab, then tap All Watches at the top of the screen. </p>
                                <div class="d-flex flex-row">
                                    <p class="grade-desc-item">4.	Tap the info button</p> <img class="d-block mt-3" src="{{asset('/images/info_button_apple.png')}}" width="24px" height="24px"> <p class="grade-desc-item">next to your Apple Watch.</p>
                                </div>
                                <p class="grade-desc-item">5.	Tap Unpair Apple Watch. For cellular Apple Watch models, tap Remove [Carrier] Plan.</p>
                                <p class="grade-desc-item">6.	Enter your Apple ID password. </p>
                                <p class="grade-desc-item">7.	Tap again to confirm. </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAppleInstructions(id){
            switch (id) {
                case 1:
                    document.getElementById('appleWifiRemove').classList.add('selected-instruction');
                    document.getElementById('applePCRemove').classList.remove('selected-instruction');
                    document.getElementById('appleWatchRemove').classList.remove('selected-instruction');

                    document.getElementById('appleWifiCollapse').classList.remove('hidden');
                    document.getElementById('applePCCollapse').classList.add('hidden');
                    document.getElementById('appleWatchCollapse').classList.add('hidden');
                    break;
                case 2:
                    document.getElementById('appleWifiRemove').classList.remove('selected-instruction');
                    document.getElementById('applePCRemove').classList.add('selected-instruction');
                    document.getElementById('appleWatchRemove').classList.remove('selected-instruction');

                    document.getElementById('appleWifiCollapse').classList.add('hidden');
                    document.getElementById('applePCCollapse').classList.remove('hidden');
                    document.getElementById('appleWatchCollapse').classList.add('hidden');
                    break;

                case 3:
                    document.getElementById('appleWifiRemove').classList.remove('selected-instruction');
                    document.getElementById('applePCRemove').classList.remove('selected-instruction');
                    document.getElementById('appleWatchRemove').classList.add('selected-instruction');

                    document.getElementById('appleWifiCollapse').classList.add('hidden');
                    document.getElementById('applePCCollapse').classList.add('hidden');
                    document.getElementById('appleWatchCollapse').classList.remove('hidden');
                    break;
            
                default:
                    break;
            }
        }
    </script>
@endif
