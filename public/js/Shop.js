var SourceUrl = 'http://127.0.0.1:8000/sell/shop/mobile?&number=24';
console.log(SourceUrl);
var queryUrl = "";
var landingUrl = "";
$(function() {
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