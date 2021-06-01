@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container" id="costs-page">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Service Costs</p>
        </div>
    </div>
    <div class="portal-table-container">

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="d-flex justify-content-between">

            <div class="col-md-4">

                <div class="d-flex">
                    <form action="/portal/settings/costs/update" style="width: 100%;" method="post">
                        @csrf
            
                        <div class="form-group">
                            <label for="admin_costs">Administration costs:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" step="0.01" id="administration_costs" name="administration_costs" pattern="^\£\d{1,3}(,\d{3})*(\.\d+)?£" data-type="currency" >
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="logistics_costs">Carriage:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" step="0.01" id="carriage_costs" name="carriage_costs" pattern="^\£\d{1,3}(,\d{3})*(\.\d+)?£" data-type="currency" >
                            </div>
                        </div>
            
                        <input type="submit" class="btn btn-primary btn-blue" value="Submit" onclick="return confirm('Are you sure you want to update costs?')">
            
                    </form>
                </div>

                <div class="d-flex">
                    <form action="/portal/settings/costs/add" style="width: 100%" method="post">
                        @csrf
            
                        <div class="form-group">
                            <label for="miscellaneous_costs">Miscellaneous cost:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" step="0.01" id="miscellaneous_costs" name="miscellaneous_costs" pattern="^\£\d{1,3}(,\d{3})*(\.\d+)?£" data-type="currency" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="per_job_deduction">Per job deduction:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" step="0.01" id="per_job_deduction" name="per_job_deduction" pattern="^\£\d{1,3}(,\d{3})*(\.\d+)?£" data-type="currency" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="live_unallocated_cost">Live unallocated cost:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" step="0.01" id="live_unallocated_cost" name="" data-type="currency" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost_description">Cost description:</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control m-0" type="text" id="cost_description" name="cost_description">
                            </div>
                        </div>
            
                        <input type="submit" class="btn btn-primary btn-blue" value="Submit" onclick="return confirm('Are you sure you want to update costs?')">
            
                    </form>
                </div>

            </div>

            <div class="col-md-7">
                <div class="d-flex mb-5 w-50">
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td></td>
                            <td>Current price</td>
                        </tr>
                        <tr>
                            <td>Administration:</td>
                            <td>£{{$additionalCosts->administration_costs}}</td>
                        </tr>
                        <tr>
                            <td>Carriage</td>
                            <td>£{{$additionalCosts->carriage_costs}}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex flex-column my-5">
                    <div class="my-3"><button id="deletemisccost" style="float: right" class="btn btn-primary" disabled>Delete</button></div>
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td>Miscellaneous cost</td>
                            <td>Per job deduction</td>
                            <td>Live unallocated cost</td>
                            <td>Cost description</td>
                            <td>Already applied to</td>
                            <td>Tag</td>
                        </tr>
                        @foreach($miscalaniousCosts as $mC)
                        <tr class="misc_cost_tr">
                            <td>£{{$mC->miscellaneous_costs}}</td>
                            <td>£{{$mC->per_job_deduction}}</td>
                            <td>£{{$mC->miscellaneous_costs - ($mC->applied_to * $mC->per_job_deduction)}}</td>
                            <td>{{$mC->cost_description}}</td>
                            <td>{{$mC->applied_to}}</td>
                            <td><input type="checkbox" class="misccost-select" data-value="{{$mC->id}}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>

// Jquery Dependency

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "£" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "£" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}


</script>

@endsection