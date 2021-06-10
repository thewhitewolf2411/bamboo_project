<?php

namespace App\Services;

use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;

class BuildingLotService{


    public static function addToLot(array $data){

        $result = null;

        if(array_key_exists("addedTradeins", $data)){
            $result = self::addTradeins($data["addedTradeins"]);
        }
        elseif(array_key_exists("addedBoxes", $data)){
            $result = self::addBoxes($data["addedBoxes"]);
        }

        return $result;
    }

    public static function removeFromLot(array $data){

        $result = null;

        if(array_key_exists('removedTradeins', $data)){
            $result = self::removeTradeins($data['removedTradeins']);
        }

        return $result;
    }


    private static function addTradeins($tradein_ids){
        #dd($tradein_ids);

        $tradeins = Tradein::find($tradein_ids);


        $selectedBoxes = [];
        $selectedTradeins = $tradein_ids;
        
        foreach($tradeins as $tradein){
            if(array_key_exists($tradein->getTrayid(), $selectedBoxes)){
                $selectedBoxes[$tradein->getTrayId()] = $selectedBoxes[$tradein->getTrayId()] + 1;
            }
            else{
                $selectedBoxes[$tradein->getTrayId()] = 1;
            }
        }

        return [$selectedBoxes, $selectedTradeins];
    }

    private static function addBoxes($box_ids){

        $selectedBoxes = [];
        $selectedTradeins = [];

        $boxes = Tray::find($box_ids);

        foreach($boxes as $box){
            $boxContent = TrayContent::where('tray_id', $box->id)->get();

            foreach($boxContent as $tradeinid){
                $tradein = Tradein::find($tradeinid->trade_in_id);

                if($tradein->isBoxed() && !$tradein->isPartOfSalesLot()){
                    if(array_key_exists($tradein->getTrayid(), $selectedBoxes)){
                        $selectedBoxes[$tradein->getTrayId()] = $selectedBoxes[$tradein->getTrayId()] + 1;
                    }
                    else{
                        $selectedBoxes[$tradein->getTrayId()] = 1;
                    }

                    array_push($selectedTradeins, $tradein->id);
                }
            }
        }

        return [$selectedBoxes, $selectedTradeins];
    }

    private static function removeTradeins($tradein_ids){
        dd($tradein_ids);
    }

}