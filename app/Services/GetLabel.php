<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use DNS1D;
use DNS2D;
use PDF;
use App\Eloquent\Tray;
use App\Eloquent\Trolley;

class GetLabel{

    private $customPaper = array(0,0,141.90,283.80);

    public function getTradeinLabel(Tradein $tradein){
        //post receiving label
        $matches = ["9"];

        if(in_array($tradein->job_state, $matches)){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');

            $pdf = PDF::loadView('portal.labels.devicelabels.receivinglabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;
        }

        //post receiving quarantine label
        $matches = ["6", "7", "8a", "8b", "8c", "8d", "8e", "8f"];
        if(in_array($tradein->job_state, $matches)){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->quarantineReason();

            $pdf = PDF::loadView('portal.labels.devicelabels.receivingquarantinelabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location,
                'quarantinereason'=>$quarantineReason))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;
        }

        //post testing label
        $matches = ["10", "12", "16"];
        if(in_array($tradein->job_state, $matches)){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->quarantineReason();
            $bambooGrade = $tradein->getDeviceBambooGrade();
            $network = $tradein->correct_network;

            $pdf = PDF::loadView('portal.labels.devicelabels.testinglabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location,
                'bambooGrade'=>$bambooGrade,
                'network'=>$network
                ))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;

        }

        //post testing quarantine label
        $matches = ["11", "11a", "11b","11c", "11d","11e", "11f","11g", "11h","11i", "11j", "15", "15a", "15b","15c", "15d","15e", "15f","15g", "15h","15i", "15j"];
        if(in_array($tradein->job_state, $matches)){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->quarantineReason();

            $pdf = PDF::loadView('portal.labels.devicelabels.testingquarantinelabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location,
                'quarantinereason'=>$quarantineReason,
                ))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;

        }

        //post quarantine label
        $matches = ["13", "14", "19", "20", "21"];
        if($tradein->wasInQuarantine()){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->getBambooStatus();
            $grade = $tradein->cosmetic_condition;
            $network = $tradein->correct_network;
            $quarantineReason = $tradein->quarantineReason();

            $pdf = PDF::loadView('portal.labels.devicelabels.testingquarantinelabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location,
                'quarantinereason'=>$quarantineReason,
                ))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;
        }


        $barcodenumber = $tradein->barcode;
        $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
        $imei = $tradein->imei_number;
        $sn = $tradein->serial_number;
        $location = $tradein->getTrayName($tradein->id);
        $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
        $quarantineReason = $tradein->quarantineReason();
        $bambooGrade = $tradein->cosmetic_condition;
        $network = $tradein->correct_network;

        $pdf = PDF::loadView('portal.labels.devicelabels.testinglabel', 
        array(
            'barcode'=>$barcode,
            'barcodenumber'=>$barcodenumber,
            'makeModel'=>$makeModel,
            'imei'=>$imei,
            'serial'=>$sn,
            'location'=>$location,
            'bambooGrade'=>$bambooGrade,
            'network'=>$network
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

        return $pdf;
    }

    public function getPostQuarantineLabel(Tradein $tradein){
        $barcodenumber = $tradein->barcode;
        $makeModel = $tradein->getProductName($tradein->product_id) . " " . $tradein->getDeviceMemory();
        $imei = $tradein->imei_number;
        $sn = $tradein->serial_number;
        $location = $tradein->getTrayName($tradein->id);
        $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
        $quarantineReason = $tradein->getBambooStatus();
        $grade = $tradein->cosmetic_condition;
        $network = $tradein->getDeviceNetwork();
        $quarantineReason = $tradein->getTestingQuarantineReason();
        $bambooGrade = $tradein->getDeviceBambooGrade();

        $pdf = PDF::loadView('portal.labels.devicelabels.postquarantinelabel', 
        array(
            'barcode'=>$barcode,
            'barcodenumber'=>$barcodenumber,
            'makeModel'=>$makeModel,
            'imei'=>$imei,
            'serial'=>$sn,
            'location'=>$location,
            'quarantinereason'=>$quarantineReason,
            'bambooGrade'=>$bambooGrade,
            'network'=>$network
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

        return $pdf;
    }

    public function getTrayLabel(Tray $tray){

        $brand="";
        switch($tray->tray_brand){
            case "A":
                $brand = "Apple";
                break;
            case "S":
                $brand = "Samsung";
                break;
            case "H":
                $brand = "Huawei";
                break;
            default:
                $brand = "Miscellaneous";
                break;
        }

        $pdf = PDF::loadView('portal.labels.traylabel', 
        array(
            'barcode'=>$tray->tray_name,
            'barcodenumber'=>$tray->tray_name,
            'models'=>$brand . " devices",
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/traylabel-'.$tray->tray_name.'.pdf');

        return $pdf;
    }

    public function getTrolleyLabel(Trolley $trolley){
        $pdf = PDF::loadView('portal.labels.trolleylabel', 
        array(
            'barcode'=>$trolley->trolley_name,
            'barcodenumber'=>$trolley->trolley_name,
            'type'=>$trolley->getTrolleyType(),
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/trolleylabel-'.$trolley->trolley_name.'.pdf');

        return $pdf;
    }

    public function getBayLabel(Trolley $bay){
        $pdf = PDF::loadView('portal.labels.baylabel', 
        array(
            'barcode'=>$bay->trolley_name,
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/baylabel-'.$bay->trolley_name.'.pdf');

        return $pdf;
    }

    public function getBinLabel(Tray $bin){
        $pdf = PDF::loadView('portal.labels.binlabel', 
        array(
            'barcode'=>$bin->tray_name,
            'barcodenumber'=>$bin->tray_name,
            'binreason'=>$bin->getBinReason(),
            'detailedreason'=>$this->getDetailedBInReason($bin),
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/binlabel-'.$bin->tray_name.'.pdf');

        return $pdf;
    }

    public function getBoxLabel(Tray $box){
        $pdf = PDF::loadView('portal.labels.boxlabel', 
        array(
            'barcode'=>$box->tray_name,
            'barcodenumber'=>"00000000" . $box->id,
            'models'=>$box->getTrayDevices() . " devices",
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/boxlabel-'.$box->tray_name.'.pdf');

        return $pdf;
    }

    public function getDetailedBInReason(Tray $bin){
        if($bin->tray_grade === 'WRPH'){
            return "Wrong Model / GB / Network";
        }
        return null;
    }

}