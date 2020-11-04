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
       'x-api-key': 'UkF4dKVYOd2AjFkEfOigY3Nd5UMrzcaR8sXZfRAW'
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
       alert("The postcode of the item you clicked on was " + $("#tags").getSelectedItemData().postcode);
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
       'x-api-key': 'UkF4dKVYOd2AjFkEfOigY3Nd5UMrzcaR8sXZfRAW'
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
       alert("The postcode of the item you clicked on was " + $("#tags").getSelectedItemData().postcode);
      }
     }
    };
    $("#delivery_address").easyAutocomplete(options);
   });