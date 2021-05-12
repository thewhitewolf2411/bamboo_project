$(function() {

    var selectItem = function(event, ui) {
     $("#billing_address").val(ui.item.value);
     return false;
    }
    var options = {
     url: function(phrase) {
      return "https://api-full.addressian.co.uk/address/" + phrase;
     },
     ajaxSettings: {
      headers: {
       'x-api-key': 'Y8L7N4WBr361XT8gHT5bc2g5ycw1ECPao3EWrs6a',
      }
     },
     getValue: function(element) {
      return element.address.join(", ") + ", " + element.citytown + ", " + element.postcode;
     },
     theme: "blue-light",
     placeholder: "Billing address",
     list: {
      maxNumberOfElements: 20,
      onClickEvent: function() {
       
      }
     }
    };
    $("#billing_address").easyAutocomplete(options);
   });

$(function() {
    var selectItem = function(event, ui) {
     $("#delivery_address").val(ui.item.value);
     return false;
    }
    var options = {
     url: function(phrase) {
      return "https://api-full.addressian.co.uk/address/" + phrase;
     },
     ajaxSettings: {
      headers: {
       'x-api-key': 'Y8L7N4WBr361XT8gHT5bc2g5ycw1ECPao3EWrs6a',
      }
     },
     getValue: function(element) {
      return element.address.join(", ") + ", " + element.citytown + ", " + element.postcode;
     },
     theme: "blue-light",
     placeholder: "Delivery address",
     list: {
      maxNumberOfElements: 20,
      onClickEvent: function() {
       
      }
     }
    };
    $("#delivery_address").easyAutocomplete(options);
   });