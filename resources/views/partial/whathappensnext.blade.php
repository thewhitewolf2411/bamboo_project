<div class="whathappensnext-container">

    <p class="what-title">
        What happens next?
    </p>
    <p class="what-subtitle mt-3">
        Watch our quick video explaining just what happens next
    </p>

    <div class="whathappens-wrapper">
        <video id="whathappens" class="whathappens-video" onclick="playVideo(true)">
            <source src="{{asset('/video/what_happens_next.mp4')}}" type="video/mp4">
        </video>
        <img id="play-icon-whathappens" class="playvideo-whathappens" src="{{asset('/video/play_video.svg')}}"  onclick="playVideo(false)">
    </div>

    @if(Auth::user())
        <div class="hr-whathappens"></div>

        <div class="image-whathappens-row">
            <div class="image-whathappens-col">
                <img class="whathappens-img" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                <p class="whathappens-large bold">Print your postage label and send your device to us</p>
                <p class="whathappens-small">
                    Please click on the link below to create and print off a FREE postage label to affix to your securely packed device with the delivery note.
                    Packing and Posting Instructions are also available here. 
                </p>
            </div>
            <div class="image-whathappens-col">
                <img class="whathappens-img" src="{{asset('/customer_page_images/body/Icon-Trust.svg')}}">
                <p class="whathappens-large bold">Verification process</p>
                <p class="whathappens-small">
                    You can check the status of your SELL order at any time using ‘My Bamboo’ section. Click below to take your straight there.
                </p>
            </div>
            <div class="image-whathappens-col">
                <img class="whathappens-img" src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">
                <p class="whathappens-large bold">Get paid! Woohoo!</p>
                <p class="whathappens-small">
                    Heres the best bit!! Once your device has tested successfully we promise to pay you directly into your bank account on the same day!!
                    *Mon-Fri, excluding public holidays. Same day payment does not apply to orders received after 2pm
                </p>
            </div>
        </div>
    @else
        <div class="row m-0 ml-auto mr-auto mt-4">
            <a href="#" class="btn btn-light">Read More</a>
        </div>
    @endif
</div>
{{-- <script type="application/javascript">

    function playVideo(isPlaying){
        let video = document.getElementById("whathappens");
        let icon = document.getElementById("play-icon-whathappens");

        if(isPlaying){
            if(icon.classList.contains('invisible')){
                icon.classList.remove('invisible');
            }
            video.pause();
            video.removeAttribute("controls");
        } else {
            icon.classList.add('invisible');
            video.play();
            video.setAttribute("controls","controls");
        }
    }
</script> --}}