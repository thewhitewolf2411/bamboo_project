<div class="sell-title-container mt-5">
    <p class="sell-title">{{$title}}</p>
    <p class="sell-subtitle mb-5 mt-4">{{$info}}</p>

    <div class="sell-search-container">
        <div class="search-bar">
            <form id="search-form" class="search-column-wrap" action="/sell/searchproducts" method="POST">
                <input type="hidden" name="topresults" value="true">
                @csrf
                <div class="sell-searchfield">
                    <input class="search-sell-input" id="searchSellDevices" type="text" name="search_argument" placeholder="Enter the make or model of your device">
                    <div class="search-sell-btn" onclick="hitSearch()"><img class="sell-search-icon" src="{{asset('/images/front-end-icons/search_icon.svg')}}"></div>
                </div>
                <div id="selling-search-results-wrapper" class="invisible">
                    <div id="selling-search-results" class="nomatches">
                        <div class="loader invisible" id="sell-results-loader"></div>
                        <div id="no-results-sorry" class="noresults invisible">
                            <img class="sorry-result-img" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                            <p class="sorry-result-text">We are sorry Boo is unable to find this make/model, please contact Customer Support on <a href="/contact#CustomerDeviceNotAvaliable">customersupport@bamboomobile.co.uk</a></p>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <a href=""><div class="d-flex mt-50">
                <p>How do I find the model, IMEI or Serial Number</p>
                <img src="{{asset('/images/front-end-icons/search_icon.svg')}}">
            </div></a> --}}
        </div>
    </div>
</div>

<script>
    function hitSearch(){
        let searchterm = document.getElementById('searchSellDevices').value;
        if(searchterm){
            document.getElementById('search-form').submit();
        }
    }

    // hide if clicking out of the input field
    // document.body.addEventListener('click', function(e){
    //     let results = document.getElementById('selling-search-results');
    //     let resultsWrapper = document.getElementById('selling-search-results-wrapper');
    //     if(results.childNodes.length > 3){
    //         var positionInfo = results.getBoundingClientRect();
    //         var height = positionInfo.height;
    //         if(e.target.id === 'searchSellDevices' && height === 0){
    //             //results.style.height = 'auto';
    //         } else {
    //             if(e.target.id === 'searchSellDevices' ){
    //                 return;
    //             }
    //             //resultsWrapper.classList.remove('invisible');
    //             //document.body.classList.remove('noscroll');

    //             results.style.height = '0';
    //         }
    //     } else {
    //         //resultsWrapper.classList.remove('invisible');
    //         //document.body.classList.remove('noscroll');
    //     }
    // });

    // disable scroll when focused
    // document.getElementById('searchSellDevices').addEventListener('click', function(e){
    //     // let resultsWrapper = document.getElementById('selling-search-results-wrapper');
    //     //  resultsWrapper.classList.add('invisible');
    //     // document.body.classList.add('noscroll');
    // });
    var input = document.getElementById('searchSellDevices');

    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 5 second for example

    //on keyup, start the countdown
    input.addEventListener('keyup', function(){
        $('.selling-single-result').remove();
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getResults, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    input.addEventListener('keydown', function(e){
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function getResults () {
        let loader = document.getElementById('sell-results-loader');
        let val = document.getElementById('searchSellDevices').value;
        let resultsdiv = document.getElementById("selling-search-results");
        let noresults = document.getElementById("no-results-sorry");
        let resultsWrapper = document.getElementById('selling-search-results-wrapper');

        // display loader
        loader.classList.remove('invisible');
        resultsWrapper.classList.remove('invisible');
        if(noresults.classList.contains('noresults')){
            noresults.classList.remove('noresults');
        }
        if(!noresults.classList.contains('invisible')){
            noresults.classList.add('invisible');
        }

        if(val){
            $.ajax({
                type: "POST",
                url: '/sell/searchdevices',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    term: val,
                },
                success: function(data, textStatus, jqXHR){
                    loader.classList.add('invisible');

                    if(resultsdiv.classList.contains('nomatches')){
                        resultsdiv.classList.remove('nomatches');
                    }
                    if(!noresults.classList.contains('invisible')){
                        noresults.classList.add('invisible');
                    }

                    if(jqXHR.status === 200){
                        
                        if(data.length > 0){

                            $('.selling-single-result').remove();

                            for (let index = 0; index < data.length; index++) {
                                let singleresult = data[index];

                                let singledevice = document.createElement('div');
                                singledevice.classList.add('selling-single-result');
                                let devicename = document.createElement('p');
                                devicename.innerHTML = singleresult.product_name;
                                singledevice.appendChild(devicename);
                                singledevice.onclick = function(){
                                    window.location = '/sell/sellitem/'+singleresult.id;
                                }

                                resultsdiv.appendChild(singledevice);
                            }
                        } else {
                            // if(noresults.classList.contains('invisible')){
                            //     noresults.classList.remove('invisible');
                            // }
                            if(!noresults.classList.contains('noresults')){
                                noresults.classList.add('noresults');
                            }
                            
                            if(noresults.classList.contains('invisible')){
                                noresults.classList.remove('invisible');
                            }
                        }

                    } else {
                        loader.classList.add('invisible');
                        // if(!resultsdiv.classList.contains('nomatches')){
                        //     resultsdiv.classList.add('nomatches');
                        // }

                        if(!noresults.classList.contains('noresults')){
                            noresults.classList.add('noresults');
                        }
                        
                        if(noresults.classList.contains('invisible')){
                            noresults.classList.remove('invisible');
                        }
                    }
                    //document.body.classList.add('noscroll');
                },
            });
        } else {
            loader.classList.add('invisible');

            var elements = document.getElementsByClassName('selling-single-result');
            while(elements.length > 0){
                elements[0].parentNode.removeChild(elements[0]);
            }
            if(!noresults.classList.contains('noresults')){
                noresults.classList.remove('noresults');
            }
            // if(!resultsdiv.classList.contains('nomatches')){
            //     resultsdiv.classList.add('nomatches');
            // }

            resultsWrapper.classList.add('invisible');
            //resultsWrapper.classList.remove('invisible');
            //document.body.classList.remove('noscroll');
        }
        
    }

</script>