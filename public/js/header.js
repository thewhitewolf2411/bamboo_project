(function() {
  window.onload = function (){

    let logo_mobile = document.getElementById('mobile-logo-img');

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if(window.innerWidth <= 625){
      if(logo_mobile.classList.contains('invisible')){
        logo_mobile.classList.remove('invisible');
      }
    }

    if(isMobile.any()){
      return;
    }

  }

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 || window.pageYOffset > 100) {
      // reduce header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');
      let logo_full = document.getElementById('full-logo-img');
      let logo_mobile = document.getElementById('mobile-logo-img');


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

      if(!logo_full.classList.contains('hidden')){
        logo_full.classList.add('hidden');
      }

      if(logo_mobile.classList.contains('invisible')){
        logo_mobile.classList.remove('invisible');
      }

    } else {
      // enlarge header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');
      let logo_full = document.getElementById('full-logo-img');
      let logo_mobile = document.getElementById('mobile-logo-img');

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

      if(logo_full.classList.contains('hidden')){
        logo_full.classList.remove('hidden');
      }

      if(window.innerWidth > 625){
        if(!logo_mobile.classList.contains('invisible')){
          logo_mobile.classList.add('invisible');
        }
      }
    }
  }

})();