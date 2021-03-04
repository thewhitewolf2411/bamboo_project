<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\NonWorkingDays;
use Carbon\Carbon;


class ExpiryDate{

    private $today;

    public function __construct(){
        $this->today = Carbon::parse(Carbon::now());
    }

    public function getExpiryDate(){

        $nonWorkingDays = $this->getNonWorkingDays();
        #dd($nonWorkingDays);
        $expiryDay = $this->today;
        $expiryDay = $expiryDay->addDays(14);
        $carbonExpiryDay = $expiryDay->format('Y-m-d');
        $this->today = Carbon::parse(Carbon::now());

        #dd($carbonExpiryDay);

        if(in_array($carbonExpiryDay, $nonWorkingDays)){
            if($expiryDay->dayOfWeek === Carbon::FRIDAY){
                $expiryDay = $expiryDay->addDays(3);
            }
        }
        else{
            if($expiryDay->dayOfWeek === Carbon::SATURDAY){
                $expiryDay = $expiryDay->addDays(2);
            }
            if($expiryDay->dayOfWeek === Carbon::SUNDAY){
                $expiryDay = $expiryDay->addDays(1);
            }
        }

        $returnDate = Carbon::parse($expiryDay)->format('Y-m-d');
        #dd($returnDate);
        return $returnDate;
    }

    private function getNonWorkingDays(){
        $nonWorkingDays = NonWorkingDays::all();

        $nonWorkingDaysArray = array();

        foreach($nonWorkingDays as $nWD){
            array_push($nonWorkingDaysArray, $nWD->non_working_date);
        }

        return $nonWorkingDaysArray;

    }

}


?>