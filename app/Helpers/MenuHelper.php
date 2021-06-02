<?php

namespace App\Helpers;

use App\Eloquent\Brand;
use App\Eloquent\SellingProduct;
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
        $mobile = SellingProduct::where('category_id', 1)->get()->pluck('brand_id')->toArray();
        $unique = array_unique($mobile);
        $brands = Brand::whereIn('id', $unique)->get();
        return $brands;
    }

    public static function getAppleTablets(){
        $sorting = new Sorting('1', '2', 13);
        return $sorting->sortDevices();
    }

    public static function getSamsungTablets(){
        $sorting = new Sorting('2', '2', 13);
        return $sorting->sortDevices();
    }

    public static function getTabletBrands(){
        $tablets = SellingProduct::where('category_id', 2)->get()->pluck('brand_id')->toArray();
        $unique = array_unique($tablets);
        $brands = Brand::whereIn('id', $unique)->get();
        return $brands;
    }

    public static function getAppleWatches(){
        $sorting = new Sorting('1', '3', 13);
        return $sorting->sortDevices();
    }

    public static function getSamsungWatches(){
        $sorting = new Sorting('2', '3', 13);
        return $sorting->sortDevices();
    }

    public static function getWatchesBrands(){
        $watches = SellingProduct::where('category_id', 3)->get()->pluck('brand_id')->toArray();
        $unique = array_unique($watches);
        $brands = Brand::whereIn('id', $unique)->get();
        return $brands;
    }

}