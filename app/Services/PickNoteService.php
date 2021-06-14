<?php

namespace App\Services;

use App\Eloquent\SalesLotContent;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;

class PickNoteService{

    private $salelotid;

    public function __construct($salelotid)
    {
        $this->salelotid = $salelotid;
    }

    public function generatePrintNote(){

        $data = $this->_generatePickNoteData();

        $this->_generatePrintNote($data);
    }

    private function _generatePrintNote(array $data){

        #dd($data);

        //\fputcsv($fp, $headers);
        $csv = fopen("php://output", 'w');

        if(count($data) === 2){
            foreach($data[0] as $box){
                \fputcsv($csv, $box);
            }
            \fputcsv($csv, ['', '', '']);
            foreach($data[1] as $device){
                \fputcsv($csv, $device);
            }
        }
        else{
            foreach($data[0] as $box){
                \fputcsv($csv, $box);
            }
        }

        \fclose($csv);

        $filename = 'PickNote' . $this->salelotid . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.csv';

        header("Content-type: application/octet-stream; charset=UTF-8");
        header('Content-Encoding: UTF-8');
        header("Content-Disposition: attachment; filename=".$filename);
        header('Content-Transfer-Encoding: binary');
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "\xef\xbb\xbf";

    }

    private function _generatePickNoteData(){

        $salesLotDevices = SalesLotContent::where('sales_lot_id', $this->salelotid)->get();

        $salesLotBoxContent = $salesLotDevices->groupBy('box_id');

        $boxarray = [
            ['Box Name', 'Bay Location', 'QTY']
        ];
        $devicearray = [
            ['Trade in barcode','Model', 'IMEI', 'Bay Location', 'Box Name']
        ];

        foreach($salesLotBoxContent as $key=>$boxContent){
            $box = Tray::find($key);
            $boxDevices = TrayContent::where('tray_id', $key)->get();

            if(count($boxDevices) === count($boxContent)){
                $pseudoArray = [$box->tray_name, $box->getTrolleyName($box->trolley_id), $box->number_of_devices];
                array_push($boxarray, $pseudoArray);
            }
            else{
                foreach($boxContent as $oneDevice){
                    $tradein = Tradein::find($oneDevice->device_id);
                    $number = 'N/A';
                    if($tradein->imei_number === null && $tradein->serial_number !== null){
                        $number = $tradein->serial_number;
                    }
                    if($tradein->imei_number !== null && $tradein->serial_number === null){
                        $number = $tradein->imei_number;
                    }
                    $pseudoArray = [$tradein->barcode, $tradein->getProductName(),  $number, $tradein->getTrayName($tradein->id), $tradein->getBayName()];
                    array_push($devicearray, $pseudoArray);
                }
            }
        }

        $dataarray = [];

        if(count($boxarray)>1){
            array_push($dataarray, $boxarray);
        }
        if(count($devicearray)>1){
            array_push($dataarray, $devicearray);
        }

        return $dataarray;

    }

}
