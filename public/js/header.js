(function() {

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 || window.pageYOffset > 100) {
      // reduce header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');

      header.style.background = 'white';
      if(!header.classList.contains('resized')){
        header.classList.add('resized');
      }
    
      if(!img.classList.contains('resized')){
        img.classList.add('resized');
      }

      if(!urls.classList.contains('resized')){
        urls.classList.add('resized');
      }

      if(!logo_container.classList.contains('resized')){
        logo_container.classList.add('resized');
      }

    } else {
      // enlarge header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');

      if(header.classList.contains('resized')){
        header.classList.remove('resized');
      }

      if(img.classList.contains('resized')){
        img.classList.remove('resized');
      }

      if(img.classList.contains('resized')){
        img.classList.remove('resized');
      }

      if(urls.classList.contains('resized')){
        urls.classList.remove('resized');
      }

      if(logo_container.classList.contains('resized')){
        logo_container.classList.remove('resized');
      }
    }
    console.log(document.getElementById('header').classList);
  }

})();