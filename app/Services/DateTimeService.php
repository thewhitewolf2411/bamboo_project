<?php 

namespace App\Services;

use \Illuminate\Support\Carbon;
use Carbon\CarbonInterval;

class DateTimeService{


    public function timeDifference($start, $end){
        $result = $this->_timeDifference($start, $end);
        return $result;
    }

    private function _timeDifference($start, $end){

        $startTime = Carbon::parse($start);
        $endTime = Carbon::parse($end);

        $totalDuration = $startTime->diffInSeconds($endTime);

        return CarbonInterval::seconds($totalDuration)->cascade()->forHumans();

    }

}