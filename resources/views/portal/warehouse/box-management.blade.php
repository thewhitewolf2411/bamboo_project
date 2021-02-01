@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Box Management</p>
        </div>
    </div>
    <div class="portal-table-container">

        <div class="container">
            <a role="button" data-toggle="modal" data-target="#createboxmodal"><div class="btn btn-primary btn-blue">
                <p style="color: #fff;">Create box</p>
            </div></a>
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

        <table class="portal-table sortable" id="box-table">
            <tr>
                <td><div class="table-element">Box No.</div></td>
                <td><div class="table-element">Grade</div></td>
                <td><div class="table-element">Manifacturer</div></td>
                <td><div class="table-element">Network</div></td>
                <td><div class="table-element">Boxed Devices</div></td>
                <td><div class="table-element">Status</div></td>
            </tr>
            @foreach ($boxes as $box)
            <tr id="{{$box->id}}" class="boxrow">
                <td><div class="table-element">{{$box->tray_name}}</div></td>
                <td><div class="table-element">{{$box->tray_grade}}</div></td>
                <td><div class="table-element">{{$box->tray_brand}}</div></td>
                <td><div class="table-element">{{$box->tray_network}}</div></td>
                <td><div class="table-element">{{$box->number_of_devices}}/{{$box->max_number_of_devices}}</div></td>
                <td><div class="table-element">{{$box->getBoxStatus()}}</div></td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

<div id="createboxmodal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Create new box</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">
            <form action="/portal/warehouse-management/box-management/createbox" method="post">
                @csrf

                <div class="form-group">
                    <label for="manifacturer">Please select manifacturer</label>
                    <select class="form-control" name="manifacturer" id="manifacturer" required>
                        <option selected value="" disabled>Please select manifacturer</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="reference">Please select reference:</label>
                    <select class="form-control" name="reference" id="reference" required>
                        <option selected value="" disabled>Please select reference</option>
                        <option value="a">A</option>
                        <option value="b+">B+</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="wsi">WSI</option>
                        <option value="wsd">WSD</option>
                        <option value="nwsi">NWSI</option>
                        <option value="nwsd">NWSD</option>
                        <option value="cat">CAT</option>
                        <option value="fimp">FIMP</option>
                        <option value="gock">GOCK</option>
                        <option value="sick">SICK</option>
                        <option value="tab">TAB</option>
                        <option value="sw">SW</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="network">Please select network:</label>
                    <select class="form-control" name="network" id="network" disabled>
                        <option selected value="" disabled>Please select network</option>
                        <option value="l">Locked</option>
                        <option value="u">Unlocked</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="capacity">Please select capacity of the box:</label>
                    <input type="number" class="form-control" name="capacity" id="capacity">
                </div>

                <div class="row">
                    <div class="col-md-6"><input type="submit" class="btn btn-primary my-3" value="Submit"></div>
                    <div class="col-md-6"><a role="button" class="w-100 my-3" data-dismiss="modal" aria-label="Cancel"><div class="btn btn-primary w-100 my-3">Cancel</div> </a></div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>

$('#reference').on('change', function(){

    if(this.value == 'a' || this.value == 'b+' || this.value == 'b' || this.value == 'c'){
        $('#network').prop('disabled', false);
        $('#network').prop('required', true);
    }
    else{
        $('#network').prop('disabled', true);
        $('#network').prop('required', false);
    }
});

$('.boxrow').on('click', function(){

    var boxid = $(this).attr('id');
    console.log(boxid);

    $.ajax({
            url: "/portal/warehouse-management/getdevices",
            type:"GET",
            data:{
                boxid:boxid,
            },
            success:function(response){

            },
        });

})

</script>

@endsection