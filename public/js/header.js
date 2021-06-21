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

    // if(window.innerWidth <= 625){
    //   if(logo_mobile.classList.contains('invisible')){
    //     logo_mobile.classList.remove('invisible');
    //   }
    // }

    if(isMobile.any()){
      return;
    }

  }

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    // if(window.innerWidth <= 625){
    if(window.innerWidth <= 768){
      return;
    }

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 || window.pageYOffset > 100) {
      // reduce header
      let header = document.getElementById('header');
      let header_selling = document.getElementById('selling-subheader-links');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');
      let logo_full = document.getElementById('full-logo-img');
      let logo_mobile = document.getElementById('mobile-logo-img');
      //let selling_arrow = document.getElementById('start-selling-button-img-down');
      let sell_mobile_submenu = document.getElementById('sellmobilephones-header-hover');
      let sell_tablets_submenu = document.getElementById('selltablets-header-hover');
      let sell_watches_submenu = document.getElementById('sellwatches-header-hover');


      header.style.background = 'white';
      if(!header.classList.contains('resized')){
        header.classList.add('resized');
      }

      if(window.innerWidth > 625){
        if(header_selling){
          if(!header_selling.classList.contains('resized')){
            header_selling.classList.add('resized');
          }
        }
      }
    
      if(!img.classList.contains('resized')){
        img.classList.add('resized');
      }

      if(sell_mobile_submenu){
        if(!sell_mobile_submenu.classList.contains('repositioned')){
          sell_mobile_submenu.classList.add('repositioned');
        }
      }

      if(sell_tablets_submenu){
        if(!sell_tablets_submenu.classList.contains('repositioned')){
          sell_tablets_submenu.classList.add('repositioned');
        }
      }
      
      if(sell_watches_submenu){
        if(!sell_watches_submenu.classList.contains('repositioned')){
          sell_watches_submenu.classList.add('repositioned');
        }
      }
      

      if(!urls.classList.contains('resized')){
        urls.classList.add('resized');
      }

      if(!logo_container.classList.contains('resized')){
        logo_container.classList.add('resized');
      }

      // if(!logo_full.classList.contains('hidden')){
      //   logo_full.classList.add('hidden');
      // }

      // if(logo_mobile.classList.contains('invisible')){
      //   logo_mobile.classList.remove('invisible');
      // }

      // if(selling_arrow.classList.contains('invisible')){
      //   document.getElementById('start-selling').classList.add('large');
      //   document.getElementById('start-selling-button-text').classList.add('margin-b');
      //   selling_arrow.classList.remove('invisible');
      // }

    } else {
      // enlarge header
      let header = document.getElementById('header');
      let header_selling = document.getElementById('selling-subheader-links');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');
      let logo_full = document.getElementById('full-logo-img');
      let logo_mobile = document.getElementById('mobile-logo-img');
      //let selling_arrow = document.getElementById('start-selling-button-img-down');
      let sell_mobile_submenu = document.getElementById('sellmobilephones-header-hover');
      let sell_tablets_submenu = document.getElementById('selltablets-header-hover');
      let sell_watches_submenu = document.getElementById('sellwatches-header-hover');


      if(header.classList.contains('resized')){
        header.classList.remove('resized');
      }
      if(header_selling){
        if(header_selling.classList.contains('resized')){
          header_selling.classList.remove('resized');
        }
      }
      

      if(img.classList.contains('resized')){
        img.classList.remove('resized');
      }

      if(sell_mobile_submenu){
        if(sell_mobile_submenu.classList.contains('repositioned')){
          sell_mobile_submenu.classList.remove('repositioned');
        }
      }
      
      if(sell_tablets_submenu){
        if(sell_tablets_submenu.classList.contains('repositioned')){
          sell_tablets_submenu.classList.remove('repositioned');
        }
      }
      
      if(sell_watches_submenu){
        if(sell_watches_submenu.classList.contains('repositioned')){
          sell_watches_submenu.classList.remove('repositioned');
        }
      }

      if(urls.classList.contains('resized')){
        urls.classList.remove('resized');
      }

      // if(logo_container.classList.contains('resized')){
      //   logo_container.classList.remove('resized');
      // }

      // if(logo_full.classList.contains('hidden')){
      //   logo_full.classList.remove('hidden');
      // }

      // if(!selling_arrow.classList.contains('invisible')){
      //   document.getElementById('start-selling').classList.remove('large');
      //   document.getElementById('start-selling-button-text').classList.remove('margin-b');

      //   selling_arrow.classList.add('invisible');
      // }

      if(window.innerWidth > 625){
        if(!logo_mobile.classList.contains('invisible')){
          logo_mobile.classList.add('invisible');
        }
      }
    }
  }


  $('#navbarSupportedContent').on('show.bs.collapse', function () {
    let icon = document.getElementById('navbar-mobile-icon');
    icon.classList.add('open');
  })

  $('#navbarSupportedContent').on('hide.bs.collapse', function () {
    let icon = document.getElementById('navbar-mobile-icon');
    icon.classList.remove('open');
  })


})();