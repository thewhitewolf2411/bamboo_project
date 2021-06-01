<?php

namespace App\Helpers;

use App\Eloquent\Brand;
use App\Services\Sorting;

class MenuHelper {

    // return [
    //     //'brandCategoryDevices => $this->getDevices(brandid, categoryid)
    //     'appleMobileDevices'=>$this->getDevices(1, 1),
    //     'appleTabletDevices'=>$this->getDevices(1, 2),
    //     'appleSWDevices'=>$this->getDevices(1, 3),
    //     'samsungMobileDevices'=>$this->getDevices(2, 1),
    //     'samsungTabletDevices'=>$this->getDevices(2, 2),
    //     'samsungSWDevices'=>$this->getDevices(2, 3),
    // ];

    // $sorting = new Sorting($brand, $category, 13);
    //     return $sorting->sortDevices();

    public static function getApplePhones(){
        $sorting = new Sorting('1', '1', 13);
        return $sorting->sortDevices();
    }

    public static function getSamsungPhones(){
        $sorting = new Sorting('2', '1', 13);
        return $sorting->sortDevices();
    }

    public static function getMobileBrands(){
        return Brand::all();
    }

}