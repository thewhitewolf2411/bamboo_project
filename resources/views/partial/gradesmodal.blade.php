<a role="button" class="my-auto ml-0" data-toggle="modal" data-target="#gradesModal">
    <label class="d-flex ml-0 mr-3 my-auto cursor-pointer">
        <img class="grades-info-img" src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mx-3">
        <p class="infotext-sell-item">What do these grades mean?</p>
    </label>
</a>

<div class="modal fade" id="gradesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header grades border-0">
                <p class="grades-info-header-text">Select condition</p>
                <div class="close-grades-box">
                    <button type="button" class="close close-grades-modal-button" data-dismiss="modal" aria-label="Close">
                        <img class="close-grades-img" src="{{ url('/images/front-end-icons/close_modal_orange.svg') }}">
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="grades-toggle-items">
                    <div class="toggle-grade-section selected-grade mr-2 ml-1" id="toggle-excellent">Excellent working</div>
                    <div class="toggle-grade-section ml-2 mr-2" id="toggle-good">Good working</div>
                    <div class="toggle-grade-section ml-2 mr-2" id="toggle-poor">Poor working</div>
                    <div class="toggle-grade-section ml-2 mr-2" id="toggle-damaged">Damaged working</div>
                    <div class="toggle-grade-section ml-2 mr-1" id="toggle-faulty">Faulty</div>
                </div>

                <div class="grades-descriptions">
                    <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc" id="excellent-description">
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Handset/Device is fully functional, working and complete</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Very Minimal wear and tear is acceptable with no marks to LCD screen</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Must not have any Water Damage</p>
                        </div>
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Touch / Face ID must be fully working</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Knox disabled</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Blocked, Stolen or fake items </p>
                        </div>
                    </div>

                    <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="good-description">
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Handset/Device is fully functional, working and complete</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Minor wear and tear is acceptable</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Must not have any Water Damage</p>
                        </div>
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Touch / Face ID must be fully working</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Knox disabled</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Blocked, Stolen or fake items</p>
                        </div>
                    </div>

                    <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="poor-description">
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Handset/Device is fully functional, working and complete</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Mid / Heavy wear and tear is acceptable </p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Must not have any Water Damage</p>
                        </div>
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Touch / Face ID must be fully working</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Knox disabled</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Blocked, Stolen or fake items </p>
                        </div>
                    </div>

                    <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="damaged-description">
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Handset/Device is fully functional, working and complete</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Mid / Heavy wear and tear is acceptable (i.e. heavy scratches or small dents) </p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Only physical damage acceptable are cracked or chipped digitiser or glass back</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Must not have any Water Damage</p>
                        </div>
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Touch / Face ID must be fully working</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Knox disabled</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Blocked, Stolen or fake items </p>
                        </div>
                    </div>

                    <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="faulty-description">
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Handset/Device is NOT fully functional</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Heavy wear and tear is acceptable (i.e. heavy scratches or small dents)</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">All components must be intact and device cannot be snapped into pieces</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Significant physical damage / Water damage</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Dust under screens or cameras</p>
                        </div>
                        <div class="grade-desc-column">
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Touch / Face ID does not work</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Software faulty</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Accept Find My iPhone, iCloud locks, Google, PIN or Password locks</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">Accept Knox disabled</p>
                            <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick.svg') }}">No Blocked, Stolen or fake items </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){
        let buttons = document.getElementsByClassName('toggle-grade-section');
        for (let index = 0; index < buttons.length; index++) {
            let button = buttons[index];
            button.onclick = function() {changeGradeSection(button.id)};
        }

        function changeGradeSection(id){
            let btn = document.getElementById(id);
            let splitted = id.split('-');
            let section = splitted[1];
            let section_container = document.getElementById(section+'-description')
            if(btn.classList.contains('selected-grade')){
                
            } else {
                $('.toggle-grade-section').removeClass('selected-grade');
                $('.grade-section-description').addClass('hidden');

                btn.classList.add('selected-grade');
                section_container.classList.remove('hidden');
            }
        }
    });
</script>