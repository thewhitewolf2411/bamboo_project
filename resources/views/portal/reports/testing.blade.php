@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Testing Reports </p>
        </div>
    </div>
    <div class="portal-table-container">
        <div class="row">
            <form action="/portal/reports/gettestingreport" method="POST" class="col-md-12">
                @csrf
    
                <div id="date-period-filter" class="col-md-12">
                    <div class="col">
                        <h5 class="text-center"> Choose date period:</h5>
                    </div>
                    <div class="d-flex w-50 m-auto">
                        <div class="input-group mr-4">
                            <input type="date" name="from"/>
                        </div>
                        <div class="input-group">
                            <input type="date" name="to"/>
                        </div>
                    </div>
                </div>
        
                <input type="submit" class="btn btn-primary btn-blue" value="Generate Testing Report">
    
            </form>
        </div>

    </div>
</div>


@endsection