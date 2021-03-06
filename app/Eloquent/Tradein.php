<?php

namespace App\Eloquent;

use App\Audits\TradeinAudit;
use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Despatch\DespatchedDevice;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;
use App\Services\DateTimeService;
use App\Services\DespatchService;
use App\Services\NotificationService;
use App\User;
use Carbon\Carbon;
use DNS1D;
use DNS2D;
use PDF;

class Tradein extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradein';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'barcode','barcode_original','product_id', 'correct_product_id','customer_grade',
        'bamboo_grade', 'job_state', 'order_price','bamboo_price','customer_memory','customer_network',
        'correct_memory','correct_network', 'product_colour', 'missing_image', 'imei_number', 'serial_number',
        'quarantine_reason', 'quarantine_date', 'offer_accepted', 'cosmetic_condition', 'cheque_number', 'tracking_reference', 
        'expiry_date', 'location_changed_at', 'trade_pack_send_by_customer', 'carriage_cost', 'admin_cost', 'misc_cost', 'pin_pattern_number',
        'fmip', 'pin_locked', 'blacklisted', 'fully_functional'
    ];


    public function getProductName(){
        if($this->correct_product_id !== null){
            return SellingProduct::where('id', $this->correct_product_id)->first()->product_name;
        }
        #dd(SellingProduct::where('id', $this->product_id)->first());
        $product = SellingProduct::where('id', $this->product_id)->first();
        return $product->product_name;
    }

    public function getCustomerProductName(){
        $product = SellingProduct::where('id', $this->product_id)->first();
        return $product->product_name;
    }

    public function getOrderDate(){
        return $this->created_at->format('d.m.Y');
    }

    public function customer(){
        $user = User::find($this->user_id);
        return $user;
    }

    public function postCode(){
        $user = $this->customer();
        $address_line = $user->delivery_address;
        $post_code = explode(',', $address_line);
        return $post_code[count($post_code)-1];
    }

    public function location(){
        return  null;
    }

    public function getProductImage($id){
        return SellingProduct::where('id', $id)->first()->product_image;
    }

    public function getBrandName($productId){

        $sellingProduct = SellingProduct::where('id', $this->product_id)->first();
        if($this->correct_product_id !== null){
            $sellingProduct = SellingProduct::where('id', $this->correct_product_id)->first();
        }
        #$sellingProduct = SellingProduct::where('id', $this->correct_product_id)->first();
        $brand = Brand::where('id', $sellingProduct->brand_id)->first();
        // fix for missing brands
        if($brand){
            return $brand->brand_name;
        }   
    }

    public function getCategoryName($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        $category = Category::where('id', $sellingProduct->category_id)->first();
        return $category->category_name;
    }

    public function getCategoryId($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        return $sellingProduct->category_id;
    }

    public function getBrandId($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        return $sellingProduct->brand_id;
    }

    public function getBrandLetter($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        if($sellingProduct->brand_id === 1){
            return "A";
        }
        else if($sellingProduct->brand_id === 2){
            return "S";
        }
        else if($sellingProduct->brand_id === 3){
            return "H";
        }
        else{
            return "M";
        }
    }

    public function getProductPrice($id, $state){
        $product = SellingProduct::where('id', $id)->first();
        $price = "";
        if($state == "Excellent working"){
            $price = $product->excellent_working;
        }
        else if($state == "Good working"){
            $price = $product->good_working;
        }
        else if($state == "Poor working"){
            $price = $product->poor_working;
        }
        else if($state == "Damaged working"){
            $price = $product->damaged_working;
        }
        else if($state == "Faulty"){
            $price = $product->faulty;
        }

        return $price;
    }

    public function getOrderType($id){

        $type = "";

        $tradeins = Tradein::where('barcode', $id)->get();
        foreach($tradeins as $tradein){
            if($this->getCategoryId($tradein->product_id) == 2){
                $type = "Type-3";
            }
        }

        if($type != "Type-3"){
            if(count($tradeins) <= 2){
                $type = "Type-1";
            }
            elseif(count($tradeins) > 2 && count($tradeins) <=5 ){
                $type = "Type-2";
            }
            else{
                $type = "Type-3";
            }
        }

        return $type;

    }

    public function getTrayName($id){
        #dd($id);
        $trayid = TrayContent::where('trade_in_id', $id)->first();

        if($trayid !== null && TrayContent::where('trade_in_id', $id)->first()->tray_id !== 0){
            $trayid = $trayid->tray_id;
            $tray = Tray::where('id', $trayid)->first();

            if($tray->trolley_id !== null){
                $trolley = Trolley::where('id', $tray->trolley_id)->first();
                if($trolley->trolley_type === "B" || $trolley->trolley_type === "Bay"){
                    //return $trolley->trolley_name;
                }
            }

            $trayname = $tray->tray_name;

            return $trayname;
        }
        else{
            if($this->deviceInPaymentProcess() || (TrayContent::where('trade_in_id', $id)->first() !== null && TrayContent::where('trade_in_id', $id)->first()->tray_id === 0)){
                
                if(SalesLotContent::where('device_id', $this->id)->first() && SalesLotContent::where('device_id', $this->id)->first()->picked){
                    return "Picked for sale lot " . SalesLotContent::where('device_id', $this->id)->first()->sales_lot_id;
                }

                return "Not assigned.";
            }

            if($this->job_state == '20' || $this->job_state == '21'){
                return "Dispatch.";
            }

            return "Not received yet.";
        }

    }

    public function getBoxName(){
        if($this->isBoxed()){
            return $this->getTrayName($this->id);
        }
        
        return 'N/A';
    }

    public function getBayName(){
        $boxid = TrayContent::where('trade_in_id', $this->id)->first();
        if($boxid !== null){
            $boxid = $boxid->tray_id;
            $box = Tray::where('id', $boxid)->first();
            if($box->trolley_id === null){
                return "Box not placed in bay.";
            }
            else{
                return Trolley::where('id', $box->trolley_id)->first()->trolley_name;
            }
            
        }
        else{
            return "Not in a box yet.";
        }
    }

    public function getStockLocation(){
        $trayid = TrayContent::where('trade_in_id', $this->id)->first();

        if($trayid !== null && TrayContent::where('trade_in_id', $this->id)->first()->tray_id !== 0){
            $trayid = $trayid->tray_id;
            $tray = Tray::where('id', $trayid)->first();

            if($tray->trolley_id !== null){
                $trolley = Trolley::where('id', $tray->trolley_id)->first();
                if($trolley->trolley_type === "B" || $trolley->trolley_type === "Bay"){
                    //return $trolley->trolley_name;
                    return $trolley->trolley_name;
                }
            }
            return 'N/A';
        }
    }

    public function getTrayId(){
        $trayid = TrayContent::where('trade_in_id', $this->id)->first();
        if($trayid !== null){
            $trayid = $trayid->tray_id;
            return $trayid;
        }
        else{
            return null;
        }
    }

    public function getTrayType(){
        $trayid = TrayContent::where('trade_in_id', $this->id)->first();
        if($trayid !== null){
            $tray = Tray::find($trayid->tray_id);
            return $tray->tray_brand;
        }
        else{
            return null;
        }
    }

    public function isGoogleLocked(){

        if($this->fmip_gock){
            return true;
        }
        return false;
    }

    public function isPinLocked(){
        if($this->pin_locked){
            return true;
        }
        return false;
    }

    public function isBlacklisted(){
        $blacklisted = ["7", "8a", "8b", "8c", "8d", "8e", "8f"];
        if(in_array($this->job_state, $blacklisted) || $this->blacklisted){
            return true;
        }
        return false;
    }

    public function isSIMLocked(){
        if($this->correct_network === "Unlocked" || $this->correct_network === null){
            return false;
        }

        return true;
    }

    public function getMissingImage(){
        return url('/storage/missing_images/'.$this->missing_image);
    }

    public function getQuarantineReason(){
        if($this->job_state === '8a' || $this->job_state === '8b' || $this->job_state === '8c' || $this->job_state === '8d' || $this->job_state === '8e' || $this->job_state === '8f'){
            return true;
        }
        return false;
    }

    public function quarantineReason(){
        #dd("here");
        if($this->isInQuarantine()){
            if($this->isGoogleLocked()){
                if($this->getBrandId($this->product_id) === 1){
                    return "FMIP Locked";
                }
                return "Google Locked";
            }
    
            if($this->isPinLocked()){
                return "Pin Locked";
            }
    
            if($this->isBlacklisted()){
                return $this->getBlacklistedIssue();
            }

            if($this->isMissing()){
                return "Lost in Transit";
            }

            if(!$this->hasImei()){
                return "No IMEI";
            }

            if($this->hasExpired()){
                return "Order Expired";
            }
    
            if($this->isDowngraded()){
                return "Downgraded";
            }

        }
        else{
            return "N/A";
        }

        return "Downgraded";
    }

    public function isMissing(){
        if($this->job_state == 4){
            return true;
        }
        return false;
    }

    public function hasImei(){
        if($this->imei_number === null){
            return false;
        }
        return true;
    }

    public function getTestingQuarantineReason(){
        //return $this->getDeviceStatus()[0];
        if($this->isGoogleLocked()){
            if($this->getBrandId($this->product_id) === 1){
                return "FMIP Locked";
            }
            return "Google Locked";
        }

        if($this->isPinLocked()){
            return "Pin Locked";
        }

        if($this->isBlacklisted()){
            return $this->getBlacklistedIssue();
        }

        if($this->isDowngraded()){
            return "Downgraded";
        }
    }

    public function hasDeviceBeenReceived(){

        $matches = ["1","2","3","4","5", "9a"];

        if(in_array($this->job_state, $matches)){
            return false;
        }
        return true;

    }

    public function hasBeenTested(){
        $matches = ["10","11","11a","11b","11c", "11d", "11e", "11f", "11g", "11h", "11i", "11j", "12", '15a', '15b', '15c', '15d', '15e', '15f', '15g', '15h', '15i', '15j', '16', '22', '23', '24', '25', '26', '27', '28', '29'];

        if(in_array($this->job_state, $matches)){
            return true;
        }
        return false;
    }

    public function deviceInPaymentProcess(){
        $matches = ["22", "23", "24", "25"];

        if(in_array($this->job_state, $matches)){
            return true;
        }
        return false;
    }

    public function inDespatch(){
        if(in_array($this->job_state, ['19', '20', '21'])){
            return true;
        }
        return false;
    }

    public function canBeDespatched(){

        if(in_array($this->job_state, ['2','3','5', '6', '7', '8a', '8b', '8c', '8d', '8e', '8f',
                                        '9','10','11','11a','11b','11c','11d','11e','11f','11g','11h','11i',
                                        '11j','12','13','14','15','15a','15b','15c','15d','15e','15f','15g',
                                        '15h','15i','15j','16','17','18','22','23','24','25','26','27'
        ])){
            if($this->deviceInPaymentProcess()){
                return false;
            }
            return true;
        }
        return false;
    }

    public function deviceLocked(){
        if($this->correct_network === 'unlocked'){
            return false;
        }
        return true;
    }

    public function getIMEIBarcode(){
        return DNS1D::getBarcodeHTML($this->imei_number, 'C128');
    }

    public function getSNBarcode(){
        return DNS1D::getBarcodeHTML($this->serial_number, 'C128');
    }

    public function isBoxed(){

        $boxcontent = TrayContent::where('trade_in_id', $this->id)->first();
        if($boxcontent !== null){
            $box = Tray::where('id', $boxcontent->tray_id)->first();
            if($box->tray_type === 'Bo'){
                return true;
            }
        }

        return false;
    }

    public function isBoxedInBay(){
        $trayid = TrayContent::where('trade_in_id', $this->id)->first();

        if($trayid !== null && TrayContent::where('trade_in_id', $this->id)->first()->tray_id !== 0){
            $trayid = $trayid->tray_id;
            $tray = Tray::where('id', $trayid)->first();

            if($tray->trolley_id !== null){
                $trolley = Trolley::where('id', $tray->trolley_id)->first();
                if($trolley->trolley_type === "B" || $trolley->trolley_type === "Bay"){
                    //return $trolley->trolley_name;
                    return true;
                }
            }
            return false;
        }
    }


    public function fullyFunctional(){
        return $this->fully_functional;
    }

    public function isFimpLocked(){
        if($this->fmip_gock && $this->getBrandId($this->product_id) === 1){
            return true;
        }
        return false;
    }

    public function isBeingReceived(){
        if(in_array($this->job_state, ['1', '2'])){
            return true;
        }
        return false;
    }

    public function stuckAtProcessing(){
        $matches = [
            '4', '5', '6', '7', 
            '8', '8a', '8b', '8c', '8d', '8e', '8f',
        ];

        if(in_array($this->job_state, $matches)){
            return true;
        }
        return false;
    }

    public function getDeviceStatus(){

        // array[0] - bamboo status
        // array[1] - customer status
        // left - database flags
        $states = [
            /*0*/   [],
            /*1*/   ['Awaiting trade pack','Order Placed'],     // old - ['Order Request received','Order Placed']
            /*2*/   ['Awaiting Receipt','Trade Pack Despatched'],
            /*3*/   ['Awaiting Receipt','Trade Pack Despatched'],
            /*4*/   ['Lost in transit','Lost in transit'],
            /*4a*/  ['Order Cancelled','Order Cancelled'],
            /*4b*/  ['Lost in transit','Expired'],
            /*5*/   ['Never Received','Expired'],
            /*6*/   ['No IMEI','Awaiting Response'],
            /*7*/   ['Blacklisted','Awaiting Response'],
            /*8a*/  ['Lost','Awaiting Response'],
            /*8b*/  ['Insurance Claim','Awaiting Response'],
            /*8c*/  ['Blocked/FRP','Awaiting Response'],
            /*8d*/  ['Stolen','Awaiting Response'],
            /*8e*/  ['Knox','Awaiting Response'],
            /*8f*/  ['Assetwatch','Awaiting Response'],
            /*9*/   ['Awaiting Testing','Trade Pack Received'],    // old - ['Awaiting Testing','Awaiting Testing']
            /*9a*/  ['Awaiting Testing','Trade Pack Received'], 
            /*9b*/  ['Awaiting Testing','Test Complete'], 
            /*10*/  ['Test Complete','Testing'],
            /* First Test results */
            /*11*/  ['Quarantine','Awaiting Response'],
            /*11a*/  ['FMIP','Awaiting Response'],
            /*11b*/  ['Google Lock','Awaiting Response'],
            /*11c*/  ['PIN Lock','Awaiting Response'],
            /*11d*/  ['Incorrect Model','Awaiting Response'],
            /*11e*/  ['Device isn\'t fully functional','Awaiting Response'],
            /*11f*/  ['Incorrect GB size','Awaiting Response'],
            /*11g*/  ['Incorrect Network','Awaiting Response'],
            /*11h*/  ['Downgrade','Awaiting Response'],
            /*11i*/  ['Downgrade','Awaiting Response'],
            /*11j*/  ['Order not valid ','Awaiting Response'],
            /*12*/  ['Test complete','Testing'],
            /*13*/  ['Awaiting retesting','Device marked for retest'],
            /*14*/  ['Awaiting retesting','Device marked for retest'],
            /* Second Test results */
            /*15*/  ['2nd Test Quarantine','Awaiting Response'],
            /*15a*/  ['FMIP','Awaiting Response'],
            /*15b*/  ['Google Lock','Awaiting Response'],
            /*15c*/  ['PIN Lock','Awaiting Response'],
            /*15d*/  ['Incorrect Model','Awaiting Response'],
            /*15e*/  ['Downgrade','Awaiting Response'],
            /*15f*/  ['Incorrect GB size','Awaiting Response'],
            /*15g*/  ['Incorrect Network','Awaiting Response'],
            /*15h*/  ['Downgrade','Awaiting Response'],
            /*15i*/  ['Downgrade','Awaiting Response'],
            /*15j*/  ['Order not valid','Awaiting Response'],
            /*16*/  ['2nd test complete','Testing'],
            /*17*/  ['Blacklisted','Order expired'],
            /*18*/  ['Device destroyed','Order expired'],
            /*19*/  ['Return to customer','Returning Device'],
            /*20*/  ['Return to customer','Returning Device'],
            /*21*/  ['Despatched','Returning Device'],
            /*22*/  ['Awaiting Box build','Awaiting payment'],
            /*23*/  ['Awaiting Box build','Submitted for payment'],
            /*24*/  ['Awaiting Box build','Payment Failed'],
            /*25*/  ['Awaiting Box build','Paid'],
            /*26*/  ['Ready For Sale','Paid'],
            /*27*/  ['Closed','Paid'],
            /*28*/  ['Part of sales lot', 'Paid'],
            /*29*/  ['Picked for sales lot', 'Paid'],
        ];

        switch($this->job_state){
            case "1":
                return $states[1];
            case "2":
                return $states[2];
            case "3":
                return $states[3];
            case "4":
                return $states[4];
            case "4a":
                return $states[5];
            case "4b":
                return $states[6];
            case "5":
                return $states[7];
            case "6":
                return $states[8];
            case "7":
                return $states[9];
            case "8a":
                return $states[10];
            case "8b":
                return $states[11];
            case "8c":
                return $states[12];
            case "8d":
                return $states[13];
            case "8e":
                return $states[14];
            case "8f":
                return $states[15];
            case "9":
                return $states[16];
            case "9a":
                return $states[17];
            case "9b":
                return $states[18];
            case "10":
                return $states[19];
            case "11":
                return $states[20];
            case "11a":
                return $states[21];
            case "11b":
                return $states[22];
            case "11c":
                return $states[23];
            case "11d":
                return $states[24];
            case "11e":
                return $states[25];
            case "11f":
                return $states[26];
            case "11g":
                return $states[27];
            case "11h":
                return $states[28];
            case "11i":
                return $states[29];
            case "11j":
                return $states[30];
            case "12":
                return $states[31];
            case "13":
                return $states[32];
            case "14":
                return $states[33];
            case "15":
                return $states[34];
            case "15a":
                return $states[35];
            case "15b":
                return $states[36];
            case "15c":
                return $states[37];
            case "15d":
                return $states[38];
            case "15e":
                return $states[39];
            case "15f":
                return $states[40];
            case "15g":
                return $states[41];
            case "15h":
                return $states[42];
            case "15i":
                return $states[43];
            case "15j":
                return $states[44];
            case "16":
                return $states[45];
            case "17":
                return $states[46];
            case "18":
                return $states[47];
            case "19":
                return $states[48];
            case "20":
                return $states[49];
            case "21":
                return $states[50];
            case "22":
                return $states[51];
            case "23":
                return $states[52];
            case "24":
                return $states[53];
            case "25":
                return $states[54];
            case "26":
                return $states[55];
            case "27":
                return $states[56];
            case "28":
                return $states[57];
            case "29":
                return $states[58];
        }
        
    }

    public function serialVisible(){
        if($this->visible_serial === null){
            return null;
        }
        return (bool)$this->visible_serial;
    }

    public function getCustomerStatus(){
        return $this->getDeviceStatus()[1];
    }

    public function getBambooStatus(){
        $blacklisted = ["7", "8a", "8b", "8c", "8d", "8e", "8f"];

        if(in_array($this->job_state, $blacklisted)){
            return "Blacklisted";
        }

        $received = [""];
        if(in_array($this->job_state, $received)){
            return "Awaiting testing";
        }

        $tested = ['11a', '11b', '11c', '11d', '11e', '11f', '11g', '11h', '11i', '11j', '15a', '15b', '15c', '15d', '15e', '15f', '15g', '15h', '15i', '15j'];
        if(in_array($this->job_state, $tested)){
            return "Test Complete";
        }

        #dd($this->getDeviceStatus());
        return $this->getDeviceStatus()[0];
    }

    public function isInQuarantine(){
        switch($this->job_state){
            case "4":
                return true;
            case "5":
                return true;
            case "6":
                return true;
            case "7":
                return true;
            case "8a":
                return true;
            case "8b":
                return true;
            case "8c":
                return true;
            case "8d":
                return true;
            case "8e":
                return true;
            case "8f":
                return true;
            case "11":
                return true;
            case "11a":
                return true;
            case "11b":
                return true;
            case "11c":
                return true;
            case "11d":
                return true;
            case "11e":
                return true;
            case "11f":
                return true;
            case "11g":
                return true;
            case "11h":
                return true;
            case "11i":
                return true;
            case "11j":
                return true;
            case "15":
                return true;
            case "15a":
                return true;
            case "15b":
                return true;
            case "15c":
                return true;
            case "15d":
                return true;
            case "15e":
                return true;
            case "15f":
                return true;
            case "15g":
                return true;
            case "15h":
                return true;
            case "15i":
                return true;
            default:
                return false;
        }
    }

    public function canProccessPayment(){
        $user = User::find($this->user_id);
        $bank_details = UserBankDetails::where('user_id', $user->id)->get();
        if($bank_details->count() > 0){
            return true;
        }
        return false;
    }

    public function customerName(){
        $user = User::find($this->user_id);
        return $user->first_name . " " . $user->last_name;
    }

    public function customerFirstName(){
        $user = User::find($this->user_id);
        return $user->first_name;
    }
    
    public function addressLine(){
        $user = $this->customer();
        $address_line = $user->delivery_address;
        $post_code = explode(',', $address_line);
        return $post_code[0];
    }

    public function addressLastLine(){
        $user = $this->customer();
        $address_line = $user->delivery_address;
        $post_code = explode(',', $address_line);
        return $post_code[1];
    }


    public function carrier(){}
    
    public function getDeviceMemory(){
        if($this->correct_memory){
            return $this->correct_memory;
        }
        return $this->customer_memory;

    }

    public function getDeviceNetwork(){
        if(isset($this->correct_network)){
            return $this->correct_network;
        }
        return $this->customer_network;
    }

    public function getDeviceColour(){
        $color = Colour::where('product_id', $this->product_id)->first();
        if($color){
            return $color->color_value;
        }
    }
    
    public function trackingReference(){
        return $this->tracking_reference;
    }

    public function isInTesting(){
        $testing_states = [
            '9', '10', '11', '12', '13', '15', '16',
            '11a', '11b', '11c', '11d', '11e', '11f', '11g', '11h', '11i', '11j',
            '15a', '15b', '15c', '15d', '15e', '15f', '15g', '15h', '15i', '15j'
        ];
        if(in_array($this->job_state , $testing_states)){
            return true;
        }
        return false;
    }

    public function getIMEIDowngradeOffer(){
        dd($this);
    }

    public function notReceivedAfterSevenDays(){
        $emailTradein = JobStateChanged::where('tradein_id', $this->id)->first();
        if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 7 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 10){
            return true;
        }
        return false;
    }

    public function notReceivedAfterTenDays(){
        $emailTradein = JobStateChanged::where('tradein_id', $this->id)->first();
        if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 10 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 14){
            return true;
        }
        return false;
    }

    public function notReceivedAfterFourteenDays(){
        $emailTradein = JobStateChanged::where('tradein_id', $this->id)->first();
        if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 14 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 21){
            return true;
        }
        return false;
    }


    public function notReceivedYet(){
        if($this->notReceivedAfterSevenDays() || $this->notReceivedAfterTenDays() || $this->notReceivedAfterFourteenDays()){
            return true;
        }
        return false;
    }

    public function hasFailedTesting(){
        $testing_faults = [
            '11a', '11b', '11c', '11d', '11e', '11f', '11g', '11h', '11i',     // first testing
            '15a', '15b', '15c', '15d', '15e', '15f', '15g', '15h', '15i'      // second testing
        ];
        if(in_array($this->job_state, $testing_faults)){
            return true;
        }
        return false;
    }

    public function wrongDevice(){
        if(isset($this->correct_product_id)){
            if($this->product_id !== $this->correct_product_id){
                return true;
            }
        }
        return false;
    }

    public function wrongMemory(){
        if(isset($this->correct_memory)){
            if($this->customer_memory !== $this->correct_memory){
                return true;
            }
        }
        return false;
    }

    public function wrongNetwork(){
        if(isset($this->correct_network)){
            if($this->customer_network !== $this->correct_network){
                return true;
            }
        }
        return false;
    }

    public function getTestingFaults(){
        $testing_faults = TestingFaults::where('tradein_id', $this->id)->first();
        $faults = [];
        $available_faults = [
            "audio_test" => "Audio Test",
            "front_microphone" => "Front Microphone",
            "headset_test" => "Headset Test",
            "loud_speaker_test" => "Loud Speaker Test",
            "microphone_playback_test" => "Microphone Playback Test",
            "buttons_test" => "Buttons Test",
            "sensor_test" => "Sensor Test",
            "camera_test" => "Camera Test",
            "glass_condition" => "Glass Condition",
            "vibration" => "Vibration",
            "original_colour" => "Original Colour",
            "battery_health" => "Battery Health",
            "nfc" => "NFC",
            "no_power" => "No Power",
            "fake_missing_parts" => "Fake Missing Parts",
            "knox_removed"=>"Knox Removed"
        ];

        if($testing_faults){
            foreach($available_faults as $fault => $text){
                if($testing_faults[$fault] !== null){
                    array_push($faults, $text);
                }
            }
        }

        
        if(count($faults) > 0){
            return implode(', ', $faults);
        }
        return null;
    }

    public function isDowngraded(){
        #dd($this->customer_grade, $this->bamboo_grade);
        if($this->customer_grade !== $this->bamboo_grade){
            return true;
        }
        return false;
    }

    public function lockedFaults(){
        if($this->isFimpLocked()){
            return 'Find My IPhone Activation Lock still active';
        }
        if($this->isGoogleLocked()){
            return 'Google Activation Lock still active';
        }
        if($this->isPinLocked()){
            return 'Pattern/PIN number not provided';
        }
        return null;
    }

    public function getReceivedDate(){
        $received = TradeinAudit::where('tradein_id', $this->id)->where('customer_status', 'Trade Pack Received')->first();
        if($received){
            return $received->created_at->format('d M, Y');
        }
        return 'Not received yet.';
    }

    public function getFaultyOffer(){
        if($this->isPinLocked()){
            return null;
        }
    }

    public function getDevicePrice(){
        /*if($this->bamboo_price > $this->order_price){
            return $this->order_price;
        }

        return $this->bamboo_price;*/

        if($this->bamboo_price){
            return $this->bamboo_price;
        }

        return $this->order_price;
    }

    public function paymentFailed(){
        if($this->job_state === "24"){
            return true;
        }
        return false;
    }

    public function isDespatched(){
        $despatched = DespatchedDevice::where('tradein_id', $this->id)->first();
        if($despatched){
            return true;
        }
        return false;
    }

    public function isManifested(){
        $despatched = DespatchedDevice::where('tradein_id', $this->id)->first();
        if($despatched){
            $despatchService = new DespatchService();
            $is_manifested = $despatchService->checkIfManifested($despatched->order_identifier);
            if($is_manifested){
                return true;
            }
        }
        return false;
    }

    public function getBlacklistedIssue(){
        switch ($this->job_state) {
            case '7':
                return 'Blacklisted.';
                break;
            case '8a':
                return 'Lost.';
                break;
            case '8b':
                return 'Insurance claim.';
                break;
            case '8c':
                return 'Blocked/FRP.';
                break;
            case '8d':
                return 'Stolen.';
                break;
            case '8e':
                return 'Device has KNOX disabled.';
                break;
            case '8f':
                return 'Assetwatch.';
                break;
            default:
                return 'N/A';
                break;
        }
    }

    public function getBlacklistedActionInfo(){
        switch ($this->job_state) {
            case '8a':
                return 'Please get in touch.';
                break;
            case '8b':
                return 'Please get in touch.';
                break;
            case '8c':
                return 'Please get in touch.';
                break;
            case '8d':
                return 'Please get in touch.';
                break;
            case '8e':
                return 'Please get in touch.';
                break;
            case '8f':
                return 'Please get in touch.';
                break;
            default:
                # code...
                break;
        }
    }
    
    public function getLastProcessorName(){
        $audit = TradeinAudit::where('tradein_id', $this->id)->orderBy('created_at', 'desc')->first();
        $user = User::find($audit->user_id);
        return $user->first_name . " " . $user->last_name;
    }

    public function deviceInReturnProcess(){
        $in_return = ['19', '20', '21'];
        if(in_array($this->job_state, $in_return)){
            return true;
        }
        return false;
    }

    public function getDeviceBambooGrade(){

        if($this->bamboo_grade === 'Catastrophic'){
            return $this->bamboo_grade;
        }

        switch($this->cosmetic_condition){
            case 'A':
                return 'Grade A';
                break;
            case 'B+':
                return 'Grade B+';
                break;
            case 'B':
                return 'Grade B';
                break;
            case 'C':
                return 'Grade C';
                break;
            default:
                return $this->cosmetic_condition;
                break;
        }
    }

    public function getTimeIn(){
        $auditTrailLatest = \Carbon\Carbon::parse($this->created_at);
        $auditTrailSecond = \Carbon\Carbon::now();

        $dateTimeService = new DateTimeService();
        $difference = $dateTimeService->timeDifference($auditTrailLatest, $auditTrailSecond);

        return $difference;
    }

    public function getDeviceCost(){
        return $this->getDevicePrice() + $this->carriage_cost + $this->admin_cost + $this->misc_cost;
    }

    public function getDeviceCustomerPrice(){
        if($this->bamboo_price > $this->order_price){
            return $this->order_price;
        }

        return $this->bamboo_price;
    }

    public function getDeviceMiscCost(){
        if($this->misc_cost){
            return $this->misc_cost;
        }
        return 0;
    }

    public function getDatePassed(){
        $tradeinauditTested = TradeinAudit::where('tradein_id', $this->id)->where('bamboo_status', 'Test Complete')->first();

        $datePassed = \Carbon\Carbon::parse($tradeinauditTested->created_at)->format('d/m/Y');

        return $datePassed;
    }

    public function getTimePassed(){
        $tradeinauditTested = TradeinAudit::where('tradein_id', $this->id)->where('bamboo_status', 'Test Complete')->order_by('created_at', 'desc')->first();

        $timePassed = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($tradeinauditTested->created_at));

        $timePassed = gmdate('H:i:s', $timePassed);

        return $timePassed;
    }

    public function getDatePaid(){
        $paymentBatchDevice = PaymentBatchDevice::where('tradein_id', $this->id)->first();

        if($paymentBatchDevice && $paymentBatchDevice->payment_state === 1){
            return \Carbon\Carbon::parse($paymentBatchDevice->updated_at)->format('d/m/Y');
        }
        return 'N/A';
    }

    public function getCancellationDate(){
        $despatchedTradein = DespatchedDevice::where('tradein_id', $this->id)->first();

        if($despatchedTradein){
            return $despatchedTradein->created_at;
        }

        return 'N/A';
    }

    public function getCustomerGradeAfterTesting(){
        switch($this->cosmetic_condition){
            case "A":
                return "Excellent Working";
            break;
            case "B+":
                return "Good Working";
            break;
            case "B":
                return "Good Working";
            break;
            case "C":
                return "Poor Working";
            break;
            case "WSI":
                return "Faulty";
            break;
            case "WSD":
                return "Faulty";
            break;
            case "NWSI":
                return "Faulty";
            break;
            case "NWSD":
                return "Faulty";
                break;
            default:
                return "N/A";
                break;
        }
    }

    public function isTablet(){
        if($this->correct_product_id){
            $product = SellingProduct::where('id', $this->correct_product_id)->first();
            if($product->category_id === 2){
                return true;
            }
        }
        else{
            $product = SellingProduct::where('id', $this->product_id)->first();
            if($product->category_id === 2){
                return true;
            }
        }

        return false;
    }

    public function isSmartWatch(){
        if($this->correct_product_id){
            $product = SellingProduct::where('id', $this->correct_product_id)->first();
            if($product->category_id === 3){
                return true;
            }
        }
        else{
            $product = SellingProduct::where('id', $this->product_id)->first();
            if($product->category_id === 3){
                return true;
            }
        }

        return false;
    }

    public function isPartOfSalesLot(){
        $saleLotContent = SalesLotContent::where('device_id', $this->id)->first();
        if($saleLotContent){
            return true;
        }

        return false;
    }

    public function getSalesLotNumber(){
        $saleLotContent = SalesLotContent::where('device_id', $this->id)->first();
        if($saleLotContent){
            return $saleLotContent->sales_lot_id;
        }

        return "N/A";
    }

    public function isPicked(){

        $saleLotContent = SalesLotContent::where('device_id', $this->id)->first();
        if($saleLotContent && $saleLotContent->picked){
            return true;
        }

        return false;
    }

    public function isInQuarantineTrayBin(){
        $tray_id = TrayContent::where('trade_in_id', $this->id)->first();
        if($tray_id){
            $tray = Tray::find($tray_id->tray_id);

            if($tray){
                if($tray->tray_brand === 'Q'){
                    return true;
                }
            }
        }

        return false;
    }

    public function wasInQuarantine(){
        if($this->quarantine_date !== null){
            return true;
        }

        return false;
    }

    public function getPaidPrice(){

        $paymentBatchDevice = PaymentBatchDevice::where('tradein_id', $this->id)->first();

        if($paymentBatchDevice && $paymentBatchDevice->payment_state === 1){
            $orderPrice = $this->order_price;
            $bambooPrice = $this->bamboo_price;
    
            $prices = [$orderPrice, $bambooPrice];
    
            return min($prices) + $this->carriage_cost + $this->admin_cost + $this->misc_cost;
        }

        return 0;
    }

    public function hasExpired(){
        $now = Carbon::now();
        $expires = Carbon::parse($this->expiry_date);
        $diff = $now->diffInDays($expires, false);

        if($diff < 0){
            $checkPrice = new \App\Services\Testing();
            $bamboogradeval = 0;

            switch($this->customer_grade){
                case 'Excellent Working':
                    $bamboogradeval = 5;
                    break;
                case 'Good Working':
                    $bamboogradeval = 4;
                    break;
                case 'Poor Working':
                    $bamboogradeval = 3;
                    break;
                case 'Damaged Working':
                    $bamboogradeval = 2;
                    break;
                case 'Faulty':
                    $bamboogradeval = 1;
                    break;
                default:
                $bamboogradeval = 5;
                    break;
            }
            $deviceCurrentPrice = $checkPrice->generateDevicePrice($this->product_id, $this->customer_memory, $this->customer_network, $bamboogradeval);
        
            if($deviceCurrentPrice < $this->order_price){
                return true;
            }
        }

        return false;
    }

    public function hasExpiredWithSamePrice(){
        $now = Carbon::now();
        $expires = Carbon::parse($this->expiry_date);
        $diff = $now->diffInDays($expires, false);

        if($diff < 0){
            $checkPrice = new \App\Services\Testing();
            $bamboogradeval = 0;

            switch($this->customer_grade){
                case 'Excellent Working':
                    $bamboogradeval = 5;
                    break;
                case 'Good Working':
                    $bamboogradeval = 4;
                    break;
                case 'Poor Working':
                    $bamboogradeval = 3;
                    break;
                case 'Damaged Working':
                    $bamboogradeval = 2;
                    break;
                case 'Faulty':
                    $bamboogradeval = 1;
                    break;
                default:
                $bamboogradeval = 5;
                    break;
            }
            $deviceCurrentPrice = $checkPrice->generateDevicePrice($this->product_id, $this->customer_memory, $this->customer_network, $bamboogradeval);
        
            if($deviceCurrentPrice === $this->order_price){
                return true;
            }
        }

        return false;
    }

    public function hasWaterDamage(){
        if($this->job_state === "15h" || $this->job_state === "11h"){
            return true;
        }

        return false;
    }

}
