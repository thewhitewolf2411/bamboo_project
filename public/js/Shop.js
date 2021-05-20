var SourceUrl = "";

if(window.location.href.indexOf('mobile')>-1){
  var SourceUrl = 'http://v3.bamboorecycle.com/sell/shop/mobile';
}
if(window.location.href.indexOf('tablets')>-1){
  var SourceUrl = 'http://v3.bamboorecycle.com/sell/shop/tablets';
}
if(window.location.href.indexOf('watches')>-1){
  var SourceUrl = 'http://v3.bamboorecycle.com/sell/shop/watches';
}


var queryUrl = "";
var landingUrl = "";
window.addEventListener('DOMContentLoaded', function(){
  $('#number_select').on('change', function () {
      if($(this).val() == 0) {
         queryUrl = "";
      } else {
          queryUrl = $(this).val();
      }
      window.location.href = MakeUrl();
  });
    
    $('#brand_select').on('change', function () {
      if($(this).val() == 0) {
         landingUrl = "";
      } else {
         landingUrl = $(this).val();
      }
      window.location.href = MakeUrl();
  });
});

function MakeUrl() {
    var finalUrl = SourceUrl + '?' +queryUrl + landingUrl;
    return finalUrl;
}