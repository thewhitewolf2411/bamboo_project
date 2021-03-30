(function() {

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    var width = window.innerWidth;

    let header_padding;
    let header_height;
    let image_margin;
    let image_width;
    let image_height;
    let image_padding;

    if(width > 1400){
      header_padding = '0 120px 0 120px';
      header_height = '150px';
      header_margin = '50px';

      image_width = '550px';
      image_height = '82px';
      image_padding = '0';
    }
    if(width < 1400 && width > 1130){
      header_padding = '0 60px 60px';
      header_height = '150px';
      header_margin = '35px';
      
      image_width = '550px';
      image_height = '82px';
      image_padding = '0';
    }
    if(width < 1130 && width > 890){
      header_padding = '0 60px 60px';
      header_height = '150px';
      header_margin = '35px';

      image_width = '550px';
      image_height = '82px';
      image_padding = '0';
    }
    if(width < 890 && width > 625){
      header_padding = '0 25px 25px';
      header_height = '100px';
      header_margin = '25px';

      image_width = 'auto';
      image_height = '50px';
      image_padding = '10px';
    }
    if(width <= 625){
      header_padding = '0 25px 25px';
      header_height = '100px';
      header_margin = '20px';

      image_width = 'auto';
      image_height = '50px';
      image_padding = '10px';
    }

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 || window.pageYOffset > 100) {
      // reduce header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');

      header.style.height = '90px';
      header.style.padding = '0 30px 60px';

      img.style.height = '50px';
      img.style.width = 'auto';

      urls.style.padding = '0 60px 0';
      urls.style.justifyContent = 'center';

      logo_container.style = 'margin-top: 45px;'
    } else {
      // enlarge header
      let header = document.getElementById('header');
      let img = document.getElementById('full-bamboo-logo');
      let urls = document.getElementById('header-urls');
      let logo_container = document.getElementById('full-logo-container');

      //header.style.height = '150px';
      //header.style.padding = '0 120px 0 120px';

      header.style.height = header_height;
      header.style.padding = header_padding;
      header.style = 'margin-top: ' + image_margin;


      img.style.height = image_height;
      img.style.width = image_width;

      urls.style.padding = '0 120px 0 120px';
      urls.style.justifyContent = 'flex-end';

      //logo_container.style = 'margin-top: 50px;'
      logo_container.style = image_margin;

    }
  }

})();