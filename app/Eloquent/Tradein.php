<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\User;

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
        'user_id', 'barcode','barcode_original','product_id','product_state', 'job_state', 'sent_themselves', 'order_price','memory','network', 'color','correct_memory','correct_network', 'received', 'device_missing', 'missing_image', 'device_correct', 'device_present_as_described', 'checkmend_passed', 'imei_number', 'change_device',
        'visible_imei', 'proccessed_before', 'bamboo_grade', 'older_than_14_days', 'quarantine_status', 'quarantine_date'
    ];


    public function getProductName($id){
        return SellingProduct::where('id', $id)->first()->product_name;
    }

    public function customer(){
        $user = User::find($this->user_id);
        return $user;
    }

    public function postCode(){
        return "71000";
    }
    
    public function location(){
        return 'Las Vegas';
    }

    public function getProductImage($id){
        return SellingProduct::where('id', $id)->first()->product_image;
    }

    public function getBrandName($productId){

        $sellingProduct = SellingProduct::where('id', $productId)->first();
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
            return "Error";
        }

    }

    public function getTrayId($id){
        $trayid = TrayContent::where('trade_in_id', $id)->first();
        if($trayid !== null){
            $trayid = $trayid->tray_id;
            $trayname = Tray::where('id', $trayid)->first()->tray_name;
            return $trayid;
        }
        else{
            return "Error";
        }
    }

    /**
     * array[0]. bamboo status
     * array[1]. customer status
     */
    public function getDeviceStatus($id, $job_state){

        switch($job_state){
            case 1:
                return ["Awaiting Trade-pack", "Order placed"];
                break;
            case 2:
                return ["Awaiting Receipt", "Trade pack despatched"];
                break;
            case 3:
                $tradein = Tradein::where('id', $id)->first();
                if($tradein->marked_for_quarantine){
                    if($tradein->device_correct){
                        return ["Incorrect Model", "Awaiting Reponse"];
                    }
                    if(!($tradein->correct_memory<$tradein->memory)){
                        return ["Incorrect GB Size", "Awaiting Reponse"];
                    }
                    if(($tradein->correct_network !== $tradein->network) && $tradein->correct_network !== null){
                        return ["Incorrect Network", "Awaiting Response"];
                    }
                    if($tradein->fimp){
                        if($tradein->getCategoryId($tradein->product_id) === 1){
                            return ["FIMP Lock", "Awaiting Response"];
                        }
                        else{
                            return ["Google Lock", "Awaiting Response"];
                        }
                    }
                    if($tradein->pinlocked){
                        return ["PIN Lock", "Awaiting Response"];
                    }
                    if(!$tradein->chekmend_passed){
                        return ["BLACKLISTED", "Awaiting Response"];
                    }
                }
                return ["Awaiting Testing", "Trade pack received, awaiting testing"];
                break;
            case 4:
                return ["Lost in transit", "Lost in transit"];
                break;
            case 5:
                $tradein = Tradein::where('id', $id)->first();
                if($tradein->proccessed_before){
                    return ["2nd Test", "Testing complete"];
                    break;
                }
                return ["1st Test", "Testing complete"];
                break;
            case 6:
                $tradein = Tradein::where('id', $id)->first();
                if($tradein->marked_for_quarantine){
                    if($tradein->device_correct){
                        return ["Incorrect Model", "Awaiting Reponse"];
                    }
                    if(!($tradein->correct_memory<$tradein->memory)){
                        return ["Incorrect GB Size", "Awaiting Reponse"];
                    }
                    if(($tradein->correct_network !== $tradein->network) && $tradein->correct_network !== null){
                        return ["Incorrect Network", "Awaiting Response"];
                    }
                    if($tradein->fimp){
                        if($tradein->getCategoryId($tradein->product_id) === 1){
                            return ["FIMP Lock", "Awaiting Response"];
                        }
                        else{
                            return ["Google Lock", "Awaiting Response"];
                        }
                    }
                    if($tradein->pinlocked){
                        return ["PIN Lock", "Awaiting Response"];
                    }
                    if(!$tradein->chekmend_passed){
                        return ["BLACKLISTED", "Awaiting Response"];
                    }
                }
                return ["2nd Test", "Testing complete"];
                break;
            case 7:
                return ["2nd Test complete", "Testing complete"];
                break;
            case 8:
                break;
            case 9:
                $tradein = Tradein::where('id', $id)->first();
                if($tradein->marked_for_quarantine){
                    if($tradein->device_correct){
                        return ["Incorrect Model", "Awaiting Reponse"];
                    }
                    if(!($tradein->correct_memory<$tradein->memory)){
                        return ["Incorrect GB Size", "Awaiting Reponse"];
                    }
                    if(($tradein->correct_network !== $tradein->network) && $tradein->correct_network !== null){
                        return ["Incorrect Network", "Awaiting Response"];
                    }
                    if($tradein->fimp){
                        if($tradein->getCategoryId($tradein->product_id) === 1){
                            return ["FIMP Lock", "Awaiting Response"];
                        }
                        else{
                            return ["Google Lock", "Awaiting Response"];
                        }
                    }
                    if($tradein->pinlocked){
                        return ["PIN Lock", "Awaiting Response"];
                    }
                    if(!$tradein->chekmend_passed){
                        return ["BLACKLISTED", "Awaiting Response"];
                    }
                }

                return ["None", "Awaiting Response"];
                break;
            case 10:
                return ["Awaiting Box Build", "Awaiting Payment"];
                break;
            case 11:
                return ["Awaiting Box Build", "Submitted for Payment"];
                break;
            case 12:
                return ["Awaiting Box Build", "Failed payment"];
                break;
            case 13:
                return ["Awaiting Box Buiild", "Paid"];
                break;
            case 14:
                return ["Ready for Sale", "Paid"];
                break;
            case 15:
                return ["Closed", "Paid"];
                break;
        }
        
    }

    public function getCustomerStatus(){
        return $this->getDeviceStatus($this->id, $this->job_state)[0];
    }

    public function getBambooStatus(){
        return $this->getDeviceStatus($this->id, $this->job_state)[1];
    }

    public function isGoogleLocked(){
        if($this->fimp){
            return true;
        }
        return $this->fimp;
    }

    public function isPinLocked(){
        if($this->pinlocked){
            return true;
        }
        return $this->pinlocked;
    }

    public function isBlacklisted(){
        // blackliststatus
        $result = ImeiResult::where('tradein_id', $this->id)->first();
        if($result){
            if($result->blackliststatus === "Yes"){
                return true;
            }
            return false;
        }
        return null;
    }

    public function isSIMLocked(){
        // greyliststatus
        $result = ImeiResult::where('tradein_id', $this->id)->first();
        if($result){
            if($result->greyliststatus === "Yes"){
                return true;
            }
            return false;
        }
        return null;
    }
}
