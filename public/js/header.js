window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    // reduce header
    let header = document.getElementById('header');
    let img = document.getElementById('full-bamboo-logo');
    let urls = document.getElementById('header-urls');
    let logo_container = document.getElementById('full-logo-container');
    header.style.height = '90px';
    img.style.height = '50px';
    img.style.width = 'auto';
    urls.style.padding = '0 60px 0';
    urls.style.justifyContent = 'center';
    header.style.padding = '0 30px 60px';
    logo_container.style = 'margin-top: 45px;'
  } else {
    // enlarge header
    let header = document.getElementById('header');
    let img = document.getElementById('full-bamboo-logo');
    let urls = document.getElementById('header-urls');
    let logo_container = document.getElementById('full-logo-container');
    header.style.height = '150px';
    img.style.height = '82px';
    img.style.width = '550px';
    urls.style.padding = '0 120px 0 120px';
    urls.style.justifyContent = 'flex-end';
    header.style.padding = '0 60px 60px';
    logo_container.style = 'margin-top: 35px;'
  }
}