<?php 
namespace app\Services;

use app\Eloquent\Tradein;

class BinService{

    public function handleDeviceBin(Tradein $tradein, $bintype){

        switch($bintype){

            case "FIMP":
                if((bool)$tradein->fimp === true){
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
                if((bool)$tradein->fimp === true){
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
                break;
            case "DEMI":
                break;
            case "BLCK":
                break;
            case "PIN":
                if((bool)$tradein->pinlocked === true){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This device is not PIN locked, and it cannot be added to this bin. ']);
                }
                break;
            case "DOWN":
                if($tradein->checkForDowngrade()[0] === "Downgraded"){
                    return response(['deviceadded'=>1, 'order'=>$tradein, 'model'=>$tradein->getProductName($tradein->product_id)]);
                }
                else{
                    return response(['deviceadded'=>0, 'error'=>'This Device is not downgraded, and it cannot be added to this bin. ']);
                }
                break;
                break;
            default:
                break;

        }

    }

}


?>