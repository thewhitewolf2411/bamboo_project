@extends('portal.layouts.portal')

@section('content')
<div class="portal-app-container">
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
                                <p>£</p>
                                <input class="form-control m-0" type="number" step="0.01" id="administration_costs" name="administration_costs" value="{{$additionalCosts->administration_costs}}">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="logistics_costs">Carriage:</label>
                            <div class="d-flex align-items-center">
                                <p>£</p>
                                <input class="form-control m-0" type="number" step="0.01" id="carriage_costs" name="carriage_costs" value="{{$additionalCosts->carriage_costs}}">
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
                                <p>£</p>
                                <input class="form-control m-0" type="number" step="0.01" id="miscellaneous_costs" name="miscellaneous_costs" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="per_job_deduction">Per job deduction:</label>
                            <div class="d-flex align-items-center">
                                <p>£</p>
                                <input class="form-control m-0" type="number" step="0.01" id="per_job_deduction" name="per_job_deduction" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Live unallocated cost:</label>
                            <div class="d-flex align-items-center">
                                <p>£</p>
                                <input class="form-control m-0" type="number" step="0.01" id="" name="" disabled>
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
                    <table class="portal-table sortable" id="categories-table">
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
                    <div class="my-3"><button style="float: right" class="btn btn-primary">Delete</button></div>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td>Miscellaneous cost</td>
                            <td>Per job deduction</td>
                            <td>Live unallocated cost</td>
                            <td>Cost description</td>
                            <td>Already applied to</td>
                            <td>Tag</td>
                        </tr>
                        @foreach($miscalaniousCosts as $mC)
                        <tr>
                            <td>{{$mC->miscellaneous_costs}}</td>
                            <td>{{$mC->per_job_deduction}}</td>
                            <td>{{$mC->miscellaneous_costs - ($mC->applied_to * $mC->per_job_deduction)}}</td>
                            <td>{{$mC->cost_description}}</td>
                            <td>{{$mC->applied_to}}</td>
                            <td><input type="checkbox" data-value="{{$mC->id}}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection