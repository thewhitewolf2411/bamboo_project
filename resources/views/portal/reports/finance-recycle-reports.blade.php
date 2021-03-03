@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Finance Recycle reports </p>
        </div>
    </div>
    <div class="portal-table-container">

        <div class="row justify-content-center">
            <div class="btn btn-primary btn-blue ml-2 mr-2" id="purchased-report-btn" onclick="setFinanceReportType('purchased')">
                Generate Purchased Units Report
            </div>

            <div class="btn btn-primary btn-blue ml-2 mr-2" id="current-report-btn" onclick="setFinanceReportType('current')">
                Generate Current Status Report
            </div>

            <div class="btn btn-primary btn-blue ml-2 mr-2" id="transfer-report-btn" onclick="setFinanceReportType('transfer')">
                Generate Device Transfer Report
            </div>
            
            <div class="btn btn-light hidden ml-2 mr-2" id="reset-selected-type" onclick="setFinanceReportType('reset')">
                Cancel
            </div>
        </div>

        <div class="row justify-content-center mt-4" id="filters">
            <div class="col hidden" id="date-period-filter">
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
            <div class="row hidden" id="status-filter">
                <select class="form-control mx-3" name="bamboo_status">
                    <option value="" disabled selected>Choose a status</option>
                </select>
            </div>
            <div class="row hidden" id="transfer_filter">
                <select class="form-control mx-3" name="transfer_status">
                    <option value="" disabled selected>Choose transfer option</option>
                </select>
            </div>
        </div>

    </div>
</div>

<script>

    function setFinanceReportType(type){
        var purchased_btn = document.getElementById('purchased-report-btn');
        var current_btn = document.getElementById('current-report-btn');
        var transfer_btn = document.getElementById('transfer-report-btn');
        var periodfilter = document.getElementById('date-period-filter');
        var statusfilter = document.getElementById('status-filter');
        var transferfilter = document.getElementById('transfer_filter');
        var reset = document.getElementById('reset-selected-type');

        switch (type) {
            case "purchased":
                if(!current_btn.classList.contains('hidden')){
                    current_btn.classList.add('hidden');
                }
                if(!transfer_btn.classList.contains('hidden')){
                    transfer_btn.classList.add('hidden');
                }
                if(periodfilter.classList.contains('hidden')){
                    periodfilter.classList.remove('hidden');
                }
                if(!statusfilter.classList.contains('hidden')){
                    statusfilter.classList.add('hidden');
                }
                if(reset.classList.contains('hidden')){
                    reset.classList.remove('hidden');
                }
                if(!transferfilter.classList.contains('hidden')){
                    reset.classList.add('hidden');
                }
                break;

            case "current":
                if(!purchased_btn.classList.contains('hidden')){
                    purchased_btn.classList.add('hidden');
                }
                if(!transfer_btn.classList.contains('hidden')){
                    transfer_btn.classList.add('hidden');
                }

                if(!periodfilter.classList.contains('hidden')){
                    periodfilter.classList.add('hidden');
                }
                if(statusfilter.classList.contains('hidden')){
                    statusfilter.classList.remove('hidden');
                }
                if(!transferfilter.classList.contains('hidden')){
                    reset.classList.add('hidden');
                }

                if(reset.classList.contains('hidden')){
                    reset.classList.remove('hidden');
                }
                break;

            case "transfer":
                if(!purchased_btn.classList.contains('hidden')){
                    purchased_btn.classList.add('hidden');
                }
                if(!current_btn.classList.contains('hidden')){
                    current_btn.classList.add('hidden');
                }

                if(periodfilter.classList.contains('hidden')){
                    periodfilter.classList.remove('hidden');
                }
                if(!statusfilter.classList.contains('hidden')){
                    statusfilter.classList.add('hidden');
                }
                if(transferfilter.classList.contains('hidden')){
                    reset.classList.remove('hidden');
                }

                if(reset.classList.contains('hidden')){
                    reset.classList.remove('hidden');
                }
                break;
        
            case "reset":
                if(purchased_btn.classList.contains('hidden')){
                    purchased_btn.classList.remove('hidden');
                }
                if(current_btn.classList.contains('hidden')){
                    current_btn.classList.remove('hidden');
                }
                if(transfer_btn.classList.contains('hidden')){
                    transfer_btn.classList.remove('hidden');
                }

                if(!periodfilter.classList.contains('hidden')){
                    periodfilter.classList.add('hidden');
                }
                if(!statusfilter.classList.contains('hidden')){
                    statusfilter.classList.add('hidden');
                }
                if(!transferfilter.classList.contains('hidden')){
                    reset.classList.add('hidden');
                }

                if(!reset.classList.contains('hidden')){
                    reset.classList.add('hidden');
                }
            default:
                break;
        }
    }

</script>


@endsection