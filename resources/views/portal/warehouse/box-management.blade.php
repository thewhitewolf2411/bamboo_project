@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Box Management</p>
        </div>
    </div>
    <div class="portal-table-container p-0">

        <div class="py-3">
            <a role="button" data-toggle="modal" data-target="#createboxmodal">
                <div class="btn btn-primary btn-blue">
                    <p style="color: #fff;">Create box</p>
                </div>
            </a>
            <a>
                <div class="btn btn-primary btn-blue" id="showinprogress">
                    <p style="color: #fff;">In progress</p>
                </div>
            </a>
            <a>
                <div class="btn btn-primary btn-blue" id="showboxed">
                    <p style="color: #fff;">Boxed</p>
                </div>
            </a>
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

        <div class="d-flex">
            <div class="col-md-7">
                <table class="portal-table uncompletebox sortable" id="box-table">
                    <tr>
                        <td><div class="table-element">Box No.</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Manufacturer</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Boxed Devices</div></td>
                        <td><div class="table-element">Status</div></td>
                        <td><div class="table-element">Open Box</div></td>
                        <td><div class="table-element">Suspend Box</div></td>
                        <td><div class="table-element">Complete Box</div></td>
                    </tr>
                    @foreach ($boxes as $box)
                        @if($box->getBoxStatus()!=='Complete')
                        <tr class="boxrowhover">
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_name}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_grade}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_brand}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_network}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->number_of_devices}}/{{$box->max_number_of_devices}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->getBoxStatus()}}</div></td>
                            <td class="py-0">@if($box->getBoxStatus()==='Open')<div class="table-element" >Box open </div> @elseif($box->getBoxStatus()==='Complete') <div class="table-element" >Box is closed </div> @else<div id="{{$box->tray_name}}" class="table-element openbox"><i class="fa fa-folder-open" aria-hidden="true" title="Open box"></i></div>@endif</div></td>
                            <td class="py-0">@if($box->getBoxStatus()==='Suspended')<div class="table-element openbox" >Box suspended</div> @elseif($box->getBoxStatus()==='Complete') <div class="table-element" >Box is closed </div  @else<div id="{{$box->tray_name}}" class="table-element suspendbox"><i class="fa fa-pause" aria-hidden="true" title="Suspend box"></div>@endif</i></div></td>
                            <td class="py-0">@if($box->getBoxStatus()==='Complete')<div class="table-element openbox" >Box closed</div> @else<div id="{{$box->tray_name}}" class="table-element closebox"><i class="fa fa-check" aria-hidden="true" title="Close box"></div>@endif</i></div></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
                <table class="portal-table completebox sortable" id="box-table">
                    <tr>
                        <td><div class="table-element">Box No.</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Manufacturer</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Boxed Devices</div></td>
                        <td><div class="table-element">Status</div></td>
                        <td><div class="table-element">Open Box</div></td>
                    </tr>
                    @foreach ($boxes as $box)
                        @if($box->getBoxStatus() === 'Complete')
                        <tr class="boxrowhover">
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_name}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_grade}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_brand}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->tray_network}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->number_of_devices}}/{{$box->max_number_of_devices}}</div></td>
                            <td class="py-0"><div class="table-element @if($box->status===1) boxrow @else boxrownotopen @endif" id="{{$box->tray_name}}">{{$box->getBoxStatus()}}</div></td>
                            <td class="py-0"><div id="{{$box->tray_name}}" class="table-element openbox"><i class="fa fa-folder-open" aria-hidden="true"></i></div></div></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>

            <div class="col-md-5 boxtablehidden" id="boxtabledevices">
                <div class="row">

                    <div class="col-md-6">
                        <form action="/portal/warehouse-management/box-management/addtobox" method="POST">
                        
                            @csrf
                            <input type="hidden" name="boxid" value="" id="adddeviceboxid">

                            <div class="form-group">
                                <label for="adddevicetradeinid">Scan or type Trade-in ID:</label>
                                <input class="form-control" type="text" name='tradeinid' id="adddevicetradeinid" required>
                            </div>

                            <input type="submit" class="btn btn-primary" id="adddevicebtn" value="Add device" disabled>
                        </form>

                        <div id="alerts"></div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-between align-items-center">
                        <div class="col-md-4">
                            <div class="btn btn-primary btn-blue printboxlabel"><p style="color: #fff">Print box label</p></div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn btn-primary btn-blue printboxmanifest"><p style="color: #fff">Print box manifest</p></div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn btn-primary btn-blue printboxsummary"><p style="color: #fff">Print box summary</p></div>
                        </div>
                    </div>

                </div>
                <table class="portal-table sortable" id="boxdevices">
                    <tr>
                        <td><div class="table-element">Box No.</div></td>
                        <td><div class="table-element">Barcode</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Manufacturer</div></td>
                        <td><div class="table-element">Model</div></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-5 boxtablehidden" id="notopen">
                <div class="row mb-5">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <div class="col-md-4">
                            <div id="" class="w-100 btn btn-primary btn-blue printboxlabel"><p style="color: #fff">Print box label</p></div>
                        </div>
                        <div class="col-md-4">
                            <div id="" class="w-100 btn btn-primary btn-blue printboxmanifest"><p style="color: #fff">Print box manifest</p></div>
                        </div>
                        <div class="col-md-4">
                            <div id="" class="w-100 btn btn-primary btn-blue printboxsummary"><p style="color: #fff">Print box summary</p></div>
                        </div>
                    </div>

                </div>
                <table class="portal-table sortable" id="notopenboxdevices">
                    <tr>
                        <td><div class="table-element">Box No.</div></td>
                        <td><div class="table-element">Barcode</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Manufacturer</div></td>
                        <td><div class="table-element">Model</div></td>
                    </tr>
                </table>
            </div>
        </div>
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
                    <label for="manifacturer">Please select manufacturer</label>
                    <select class="form-control" name="manifacturer" id="manifacturer" required>
                        <option selected value="" disabled>Please select manufacturer</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                        <option value="M">Miscellaneous</option>
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
                        <option value="fimp">FMIP</option>
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
                    <label for="boxdevices">Please select Box devices:</label>
                    <select class="form-control" name="boxdevices" id="boxdevices">
                        <option selected value="" disabled>Please select box devices</option>
                        <option value="1">Mobile Phones</option>
                        <option value="2">Tablets</option>
                        <option value="3">Smart watches</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="capacity">Please select capacity of the box:</label>
                    <input type="number" max="100" class="form-control" name="capacity" id="capacity" required>
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

@if(Session::has('addedtobox'))

<script
			src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>

<script>

    var boxname = "{{Session::get('addedtobox')}}";

    $('.boxrowhover').each(function(){
        $(this).removeClass('boxrowhoverselected');
    });

    $('.boxrow#' + boxname).parent().parent().toggleClass('boxrowhoverselected');

    $('#boxtabledevices').removeClass('boxtablehidden');
    $('#notopen').addClass('boxtablehidden');

    $.ajax({
        url: "/portal/warehouse-management/getdevices",
        type:"GET",
        data:{
            boxname:boxname,
        },
        success:function(response){
            $('.tabledevices').remove();
            $('#adddeviceboxid').prop('value', '');
            $('#adddeviceboxid').prop('value', boxname);
            $('#adddevicetradeinid').focus();
            for(var i = 0; i<response.length; i++){
                $('#boxdevices').append('<tr class="tabledevices"><td><div class="table-element">' + boxname + '</div></td><td><div class="table-element">' + response[i].barcode + '</div></td><td><div class="table-element">' + response[i].bamboo_grade + '</div></td><td><div class="table-element">' + response[i].imei_number + '</div></td><td><div class="table-element">' + response[i].product_id + '</div></td><td><div class="table-element">' + response[i].model + '</div></td></tr>')
            }
        },
    });
    


</script>

@endif



@endsection