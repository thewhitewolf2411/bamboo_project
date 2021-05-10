<div class="support-search-element">
    <div class="text-center">
        <p class="support-subtitle">How can we help?</p>
    </div>

    <div class="text-center">
        <p class="support-subtitle-info bebas-neue">USE THE SEARCH BAR BELOW OR SELECT FROM ONE OF THE OPTIONS BELOW</p>
    </div>

    {{-- <div class="search-bar">
        <form class="support-search-form" action="/searchsupport" method="POST">
            @csrf
            <input class="support-search" type="text" placeholder="Search...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div> --}}
    <form class="support-search-form" action="/searchsupport" method="POST">
        <div class="search-wrapper-support">
            <div class="search-field-wrapper-support">
                <input class="support-search" id="searchSupportFAQ" type="text" placeholder="Ask a question...">
                <div class="support-search-btn">
                    <img src="{{asset('images/front-end-icons/search_icon.svg')}}">
                </div>
            </div>
        </div>
        <div class="support-search-results-wrapper hidden" id="support-wrapper">
            <div class="support-search-results" id="suppport-faq-results">
                <p class="support-search-related-searches-title">Related searches</p>
                {{-- <a class="support-search-result" href="#">How do i find my serial number</a>
                <a class="support-search-result" href="#">How do i find my IMEI number</a>
                <a class="support-search-result" href="#">How do i find my model number</a> --}}
            </div>
        </div>
    </form>

</div>

<script>

    // hide if clicking out of the input field
    document.body.addEventListener('click', function(e){
        let results = document.getElementById('suppport-faq-results');
        let wrapper = document.getElementById('support-wrapper');
        if(results.childNodes.length > 3){
            var positionInfo = results.getBoundingClientRect();
            var height = positionInfo.height;
            if(e.target.id === 'searchSupportFAQ' && height === 0){
                wrapper.classList.remove('hidden');
            } else {
                if(e.target.id === 'searchSupportFAQ' ){
                    return;
                }
                document.body.classList.remove('noscroll');
                wrapper.classList.add('hidden');
            }
        } else {
            //document.body.classList.remove('noscroll');
        }
    });

    // disable scroll when focused
    document.getElementById('searchSupportFAQ').addEventListener('click', function(e){
        //document.body.classList.add('noscroll');
    });


    document.getElementById('searchSupportFAQ').addEventListener('keyup', function(e){
        setTimeout(() => {
            let val = document.getElementById('searchSupportFAQ').value;
            let resultsdiv = document.getElementById("suppport-faq-results");
            let wrapper = document.getElementById('support-wrapper');

            if(val){
                wrapper.classList.remove('hidden');
                $.ajax({
                    type: "POST",
                    url: '/support/searchfaq',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        term: val,
                    },
                    success: function(data, textStatus, jqXHR){
                        $('.support-search-result').remove();
                        if(jqXHR.status === 200){
                            
                            if(data.length > 0){

                                $('.support-search-result').remove();

                                for (let index = 0; index < data.length; index++) {
                                    let singleresult = data[index];

                                    let question = document.createElement('a');
                                    question.classList.add('support-search-result');
                                    question.innerHTML = singleresult.question;
                                    question.href = '/support/selling/'+singleresult.id;
                                    resultsdiv.appendChild(question);
                                }
                            }

                        } else {
                            if(!resultsdiv.classList.contains('nomatches')){
                                resultsdiv.classList.add('nomatches');
                            }
                        }
                        //document.body.classList.add('noscroll');
                    },
                });
            } else {
                var elements = document.getElementsByClassName('selling-single-result');
                while(elements.length > 0){
                    elements[0].parentNode.removeChild(elements[0]);
                }
                //document.body.classList.remove('noscroll');
                wrapper.classList.add('hidden');
            }
            
        }, 1000);
    })
</script>