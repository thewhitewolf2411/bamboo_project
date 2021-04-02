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
            $makeModel = $tradein->getProductName($tradein->product_id);
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
            $makeModel = $tradein->getProductName($tradein->product_id);
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->getBambooStatus();

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
            $makeModel = $tradein->getProductName($tradein->product_id);
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->getBambooStatus();
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
            $makeModel = $tradein->getProductName($tradein->product_id);
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->getTestingQuarantineReason();

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
        if(in_array($tradein->job_state, $matches)){
            $barcodenumber = $tradein->barcode;
            $makeModel = $tradein->getProductName($tradein->product_id);
            $imei = $tradein->imei_number;
            $sn = $tradein->serial_number;
            $location = $tradein->getTrayName($tradein->id);
            $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
            $quarantineReason = $tradein->getBambooStatus();
            $grade = $tradein->cosmetic_condition;
            $network = $tradein->correct_network;

            $pdf = PDF::loadView('portal.labels.devicelabels.testingquarantinelabel', 
            array(
                'barcode'=>$barcode,
                'barcodenumber'=>$barcodenumber,
                'makeModel'=>$makeModel,
                'imei'=>$imei,
                'serial'=>$sn,
                'location'=>$location,
                ))
            ->setPaper($this->customPaper, 'landscape')
            ->save('pdf/devicelabel-'.$barcodenumber.'.pdf');

            return $pdf;
        }


        $barcodenumber = $tradein->barcode;
        $makeModel = $tradein->getProductName($tradein->product_id);
        $imei = $tradein->imei_number;
        $sn = $tradein->serial_number;
        $location = $tradein->getTrayName($tradein->id);
        $barcode = DNS1D::getBarcodePNG($tradein->barcode, 'C128');
        $quarantineReason = $tradein->getBambooStatus();
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


    public function getTrayLabel(Tray $tray){

        $pdf = PDF::loadView('portal.labels.traylabel', 
        array(
            'barcode'=>$tray->tray_name,
            'barcodenumber'=>$tray->tray_name,
            'models'=>$tray->getTrayDevices() . " devices",
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
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/binlabel-'.$bin->tray_name.'.pdf');

        return $pdf;
    }

    public function getBoxLabel(Tray $box){
        $pdf = PDF::loadView('portal.labels.boxlabel', 
        array(
            'barcode'=>$box->tray_name,
            'barcodenumber'=>$box->tray_name,
            'models'=>$box->getBoxBrand() . " devices",
            ))
        ->setPaper($this->customPaper, 'landscape')
        ->save('pdf/boxlabel-'.$box->tray_name.'.pdf');

        return $pdf;
    }

}