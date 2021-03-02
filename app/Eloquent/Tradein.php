<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
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
        'correct_memory','correct_network', 'missing_image', 'imei_number', 'serial_number',
        'quarantine_reason', 'quarantine_date', 'offer_accepted', 'cosmetic_condition', 'cheque_number', 'tracking_reference', 'expiry_date'
    ];


    public function getProductName($id){
        if($this->correct_product_id !== null){
            return SellingProduct::where('id', $this->correct_product_id)->first()->product_name;
        }
        //dd(SellingProduct::where('id', $id)->first(), $this);
       // return SellingProduct::where('id', $id)->first()->product_name;
       return SellingProduct::where('id', $this->product_id)->first()->product_name;
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
        $address_line = $user->billing_address;
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

        // $sellingProduct = SellingProduct::where('id', $productId)->first();
        $sellingProduct = SellingProduct::where('id', $this->product_id)->first();
        $brand = Brand::where('id', $sellingProduct->brand_id)->first();
        return $brand->brand_name;
    }

    public function getCategoryName($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        $category = Category::where('id', $sellingProduct->brand_id)->first();
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
        if($trayid !== null){
            $trayid = $trayid->tray_id;
            $trayname = Tray::where('id', $trayid)->first()->tray_name;
            return $trayname;
        }
        else{
            return "Not received yet.";
        }

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

    public function isGoogleLocked(){
        if($this->job_state === '11a' || $this->job_state === '11b' || $this->job_state === '11a' || $this->job_state === '11b'){
            return true;
        }
        return false;
    }

    public function isPinLocked(){
        if($this->job_state === '11c' || $this->job_state === '15c'){
            return true;
        }
        return false;
    }

    public function isBlacklisted(){
        if($this->job_state === '7'){
            return true;
        }
        return false;
    }

    public function isSIMLocked(){
        return null;
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

    public function hasDeviceBeenReceived(){

        $matches = ["1","2","3","4","5"];

        if(in_array($this->job_state, $matches)){
            return false;
        }
        return true;

    }

    public function hasBeenTested(){
        $matches = ["10","11","11a","11b","11c", "11d", "11e", "11f", "11g", "11h", "11i", "11j", "12"];

        if(in_array($this->job_state, $matches)){
            return true;
        }
        return false;
    }

    public function deviceInPaymentProcess(){
        $matches = ["22", "23", "25"];

        if(in_array($this->job_state, $matches)){
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

    public function getDeviceLabel(){
        $barcodeNumber = $this->barcode;
        $barcode = DNS1D::getBarcodeHTML($this->barcode, 'C128');
        $location = $this->getTrayName($this->id);

        $customPaper = array(0,0,141.90,283.80);

        $quarantineReason = $this->getBambooStatus();


        if($this->isInQuarantine()){
            
            $pdf = PDF::loadView('portal.labels.devicelabels.quarantinelabel', 
            array(
                'barcode_number'=>$barcodeNumber,
                'manifacturer'=>$this->getBrandName($this->product_id),
                'model'=>$this->getProductName($this->product_id),
                'imei'=>$this->imei_number,
                'location'=>$location,
                'quarantineReason'=>$quarantineReason,
                'barcode'=>$barcode,
                ))
            ->setPaper($customPaper, 'landscape')
            ->save('pdf/devicelabel-'. $barcodeNumber .'.pdf');

            return true;
        }
        else if($this->job_state === "10"){
            $pdf = PDF::loadView('portal.labels.devicelabels.testingpassed', 
            array(
                'barcode_number'=>$barcodeNumber,
                'manifacturer'=>$this->getBrandName($this->product_id),
                'model'=>$this->getProductName($this->product_id),
                'imei'=>$this->imei_number,
                'location'=>$location,
                'bambooGrade'=>$this->cosmetic_condition,
                'network'=>$this->correct_network,
                'barcode'=>$barcode,
                ))
            ->setPaper($customPaper, 'landscape')
            ->save('pdf/devicelabel-'. $barcodeNumber .'.pdf');

            return true;
        }
        else{
            $pdf = PDF::loadView('portal.labels.devicelabels.receivingpass', 
            array(
                'barcode_number'=>$barcodeNumber,
                'manifacturer'=>$this->getBrandName($this->product_id),
                'model'=>$this->getProductName($this->product_id),
                'imei'=>$this->imei_number,
                'location'=>$location,
                'barcode'=>$barcode,
                ))
            ->setPaper($customPaper, 'landscape')
            ->save('pdf/devicelabel-'. $barcodeNumber .'.pdf');

            return true;
        }
    }

    public function isFullyFunctional(){
        $matches = ["11e", "15e"];

        if(in_array($this->job_state, $matches)){
            return false;
        }
        return true;
    }

    public function isFimpLocked(){
        $matches = ["11a", "11b", "15a", "15b"];

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
            /*2*/   ['Awaiting Receipt/Customer Sent','Trade Pack Despatched'],
            /*3*/   ['Awaiting Receipt','Trade Pack Despatched'],
            /*4*/   ['Lost in transit','Lost in transit'],
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
            /*10*/  ['Device has passed testing','Testing'],
            /* First Test results */
            /*11*/  ['Quarantine','Awaiting Response'],
            /*11a*/  ['FMIP','Awaiting Response'],
            /*11b*/  ['Google Lock','Awaiting Response'],
            /*11c*/  ['PIN Lock','Awaiting Response'],
            /*11d*/  ['Incorrect Model','Awaiting Response'],
            /*11e*/  ['Device isn\'t fully functional','Awaiting Response'],
            /*11f*/  ['Incorrect Memory','Awaiting Response'],
            /*11g*/  ['Incorrect Network','Awaiting Response'],
            /*11h*/  ['Signs of water damage','Awaiting Response'],
            /*11i*/  ['Downgrade','Awaiting Response'],
            /*11j*/  ['Older than 14 days','Awaiting Response'],
            /*12*/  ['Device has passed testing','Testing'],
            /*13*/  ['Device was requested for retest','Awaiting Testing'],
            /*14*/  ['Awaiting 2nd Test','Awaiting Testing'],
            /* Second Test results */
            /*15*/  ['2nd Test Quarantine','Awaiting Response'],
            /*15a*/  ['FMIP','Awaiting Response'],
            /*15b*/  ['Google Lock','Awaiting Response'],
            /*15c*/  ['PIN Lock','Awaiting Response'],
            /*15d*/  ['Incorrect Model','Awaiting Response'],
            /*15e*/  ['Device isn\'t fully functional','Awaiting Response'],
            /*15f*/  ['Incorrect Memory','Awaiting Response'],
            /*15g*/  ['Incorrect Network','Awaiting Response'],
            /*15h*/  ['Signs of water damage','Awaiting Response'],
            /*15i*/  ['Downgraded','Awaiting Response'],
            /*15j*/  ['Older than 14 days','Awaiting Response'],
            /*16*/  ['Device has passed 2nd testing','Testing'],
            /*17*/  ['Device marked for destruction','Order expired'],
            /*18*/  ['Device destroyed','Order expired'],
            /*19*/  ['Device requested by customer','Returning Device'],
            /*20*/  ['Device marked to return to customer','Returning Device'],
            /*21*/  ['Despatched to customer','Returning Device'],
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
            case "5":
                return $states[5];
            case "6":
                return $states[6];
            case "7":
                return $states[7];
            case "8a":
                return $states[8];
            case "8b":
                return $states[9];
            case "8c":
                return $states[10];
            case "8d":
                return $states[11];
            case "8e":
                return $states[12];
            case "8f":
                return $states[13];
            case "9":
                return $states[14];
            case "10":
                return $states[15];
            case "11":
                return $states[16];
            case "11a":
                return $states[17];
            case "11b":
                return $states[18];
            case "11c":
                return $states[19];
            case "11d":
                return $states[20];
            case "11e":
                return $states[21];
            case "11f":
                return $states[22];
            case "11g":
                return $states[23];
            case "11h":
                return $states[24];
            case "11i":
                return $states[25];
            case "11j":
                return $states[26];
            case "12":
                return $states[27];
            case "13":
                return $states[28];
            case "14":
                return $states[29];
            case "15":
                return $states[30];
            case "15a":
                return $states[31];
            case "15b":
                return $states[32];
            case "15c":
                return $states[33];
            case "15d":
                return $states[34];
            case "15e":
                return $states[35];
            case "15f":
                return $states[36];
            case "15g":
                return $states[37];
            case "15h":
                return $states[38];
            case "15i":
                return $states[39];
            case "15j":
                return $states[40];
            case "16":
                return $states[41];
            case "17":
                return $states[42];
            case "18":
                return $states[43];
            case "19":
                return $states[44];
            case "20":
                return $states[45];
            case "21":
                return $states[46];
            case "22":
                return $states[47];
            case "23":
                return $states[48];
            case "24":
                return $states[49];
            case "25":
                return $states[50];
            case "26":
                return $states[51];
            case "27":
                return $states[52];
            case "28":
                return $states[53];
            case "29":
                return $states[54];
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
        $matches = ["8a", "8b", "8c", "8d", "8e", "8f"];

        if(in_array($this->job_state, $matches)){
            return "Blacklisted";
        }
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
    
    public function addressLine(){
        $user = $this->customer();
        $address_line = $user->billing_address;
        $post_code = explode(',', $address_line);
        return $post_code[0];
    }

    public function carrier(){}
    
    public function trackingReference(){
        return $this->tracking_reference;
    }
}
