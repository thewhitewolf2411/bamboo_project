<?php

namespace App\Services;

use App\User;
use DNS1D;
use PDF;

class LabelService{


    public function printFreePostageLabel($tradein){
        $user = User::find($tradein->user_id);
        $name = $user->first_name . " " . $user->last_name;
        $address = $user->delivery_address;
        $barcode = $tradein->barcode;
        $created_at = $tradein->updated_at;
        $barcodeimage = DNS1D::getBarcodeHTML($barcode, 'C128');

        $delAdress = strtr($address, array(', '=>'<br>'));

        $html = "";
        $html .= "<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<p>" . $name . ",</p>";
        $html .= "<p>". $delAdress .",</p>";
        $html .= "<br><br>";
        $html .= "<p>Order#". $barcode . " Date: " . $created_at .  "</p>";
        $html .= "<p>Dear " . $name . ",</p>";
        $html .= "<p>Thank you very much for using Bamboo Recycle to recycle your mobile device(s). This package contains your TradePack which you can use to post your recycled device(s) back to Bamboo. Please follow the instructions below on how toreturn your recycled device(s) to Bamboo:</p>";
        $html .= "  <ol>
                        <li>Gather your recycled device(s) and remove any sim cards or memory cards from thedevice(s).</li>
                        <li>Place the device(s) into the Trade Pack that you received from Bamboo with this package. (Please rememberwe only require the handset, unless of course the device you're recycling is brand new and boxed.)</li>
                        <li>Next, seal the Trade Pack by folding over the sticky flap at the top.</li>
                        <li>Finally, you must then place the Freepost Label, found on the bottom left of this letter, onto the front of the TradePack then post your Trade Pack back to Bamboo!</li>
                    </ol> ";
        $html .= "<p>Once your recycled device(s) are received by Bamboo you will be sent an email confirming this. Your device(s) will thenbe tested to make sure they match the conditions that were set when placing the order. After each device has beensuccessfully tested you will receive a final email confirming payment for the device using the method that you selected.(Please note: Payment will be made on a per device basis.)<br>If you have any problems returning your device(s) please view the FAQs section on our website or contact us directly byemailing customersupport@bamboorecycle.com with your enquiry.</p>";
        $html .= "<p>Kind Regards,</p>";
        $html .= "<p>Bamboo Mobile</p>";
        $html .= "<h3>Freepost return address</h3>";
        $html .=    "<div style='clear:both; position:relative; display:flex;'>
                        <div style='width:190pt; height:150px;' >
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
                        </div>
                        <div style='margin-left:200pt; margin-top:-150px; width:190pt; height:150px;'>
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
                        </div>
                    </div>";
        #echo $html;
        #die();

        $filename = "labeltradeout-" . $barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        return response(['code'=>200, 'filename'=>$filename]);
    }

    public function printSpecialDeliveryLabel(){
        // $html = "";
        // $html .= "<style>html{width:120px;height: 100px;}p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        // $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg' width='120px' height='40px' style='display:block; margin-left:auto; margin-right:auto;'>";
        // $html .= "<p style='margin-top: 60px;'>FREEPOST 555880PR</p>";
        // $html .= "<p<Bamboo Recycle (9100)</p>";
        // $html .= "<p>C/O Bamboo Distribution Ltd</p>";
        // $html .= "<p>Unit 1, I.O Centre</p>";
        // $html .= "<p>Lea Road</p>";
        // $html .= "<p>Waltham Abbey</p>";
        // $html .= "<p>Hertfordshire</p>";
        // $html .= "<p>EN9 1AS</p>";

        $filename = "special_delivery_label.pdf";
        $custom_paper = array(0,0,283.465,425.197);

        PDF::loadView('portal.labels.specialdeliverylabel')->setPaper($custom_paper, 'portrait')->setWarnings(false)->save($filename);
        return response(['code'=>200, 'filename'=>$filename]);
    }


    public function downloadSDLabel(){
        // $html = "";
        // $html .= "<style>html{width:120px;height: 100px;}p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        // $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg' width='120px' height='40px' style='display:block; margin-left:auto; margin-right:auto;'>";
        // $html .= "<p style='margin-top: 60px;'>FREEPOST 555880PR</p>";
        // $html .= "<p<Bamboo Recycle (9100)</p>";
        // $html .= "<p>C/O Bamboo Distribution Ltd</p>";
        // $html .= "<p>Unit 1, I.O Centre</p>";
        // $html .= "<p>Lea Road</p>";
        // $html .= "<p>Waltham Abbey</p>";
        // $html .= "<p>Hertfordshire</p>";
        // $html .= "<p>EN9 1AS</p>";

        $filename = "special_delivery_label.pdf";
        // 100 - 150 cm to pt approx
        $custom_paper = array(0,0,283.465,425.197);
        //$custom_paper = array(0,0,323.465,425.197);

        PDF::loadView('portal.labels.specialdeliverylabel')->setPaper($custom_paper, 'portrait')->setWarnings(false)->save($filename);

        return response()->file($filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);        
    }
}