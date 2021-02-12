<?php 
namespace app\Services;

use app\Eloquent\Tradein;

class BinService{

    public function handleDeviceBin(Tradein $tradein, $bintype){


        return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);

        /*
        switch($bintype){

            case "FIMP":
                if($tradein->job_state === '11a' || $tradein->job_state === '15a'){
                    if($tradein->getCategoryId($tradein->product_id) === 1){

                        return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                    }
                    else{
                        return response(['deviceadded'=>0, 'error'=>'This device is not Apple product, and it cannot be added to this bin.']);
                    }
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not FIMP locked, and it cannot be added to this bin. ']);
                }
                break;
            case "GOCK";
                if($tradein->job_state === '11b' || $tradein->job_state === '15b'){
                    if($tradein->getCategoryId($tradein->product_id) !== 1){

                        return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                    }
                    else{
                        return response(['deviceadded'=>0, 'error'=>'This device is Apple product product.']);
                    }
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not FIMP locked, and it cannot be added to this bin. ']);
                }
                break;
            case "WRPH":
                if($tradein->job_state === '11d' || $tradein->job_state === '15d' || $tradein->job_state === '11f' || $tradein->job_state === '15f' || $tradein->job_state === '11g' || $tradein->job_state === '15g'){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device isn\'t in quarantine because model/memory/network is incorrect and cannot be added to this bin. ']);
                }
                break;
            case "DEMI":
                if($tradein->job_state === '4'){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not lost in transit, and cannot be placed in this bin. ']);
                }
                break;
            case "BLCK":
                if($tradein->job_state === '7' || $tradein->job_state === '8a' || $tradein->job_state === '8b' || $tradein->job_state === '8c' || $tradein->job_state === '8d' || $tradein->job_state === '8e' || $tradein->job_state === '8f'){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not blacklisted, and cannot be placed in this bin. ']);
                }
                break;
            case "PIN":
                if($tradein->job_state === '11c' || $tradein->job_state === '15c'){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not PIN locked, and it cannot be added to this bin. ']);
                }
                break;
            case "DOWN":
                if($tradein->job_state === '11i' || $tradein->job_state === '15i'){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This Device is not downgraded, and it cannot be added to this bin. ']);
                }
                break;
            default:
                break;

        }

        */

    }

}


?>