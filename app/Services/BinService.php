<?php 
namespace app\Services;

use app\Eloquent\Tradein;
use app\Eloquent\Tray;

class BinService{

    public function handleDeviceBin(Tradein $tradein, $bintype, $binname){

        #dd();

        if($tradein->getTrayName($tradein->id) === $binname){

            return response(['deviceadded'=>0, 'error'=>'Device already allocated to bin.']);

        }

        if(!$tradein->isInQuarantine()){

            return response(['deviceadded'=>0, 'error'=>'Device is not in quarantine.']);
            
        }

        $grade = $tradein->getDeviceBambooGrade() ? $tradein->getDeviceBambooGrade() : 'N/A';
        $tradein->imei_number = $tradein->imei_number ? $tradein->imei_number : 'N/A';
        $tradein->serial_number = $tradein->serial_number ? $tradein->serial_number : 'N/A';

        return response(['deviceadded'=>1, 'order'=>$tradein, 'grade'=>$grade ,'model'=>$tradein->getProductName($tradein->product_id)]);


    }

}


?>