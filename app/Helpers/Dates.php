<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class Dates{

    public static function getDays(){
        return [
            '01','02','03','04','05','06','07','08','09','10',
            '11','12','13','14','15','16','17','18','19','20',
            '21','22','23','24','25','26','27','28','29','30','31'
        ];
    }

    public static function getMonths(){
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
    }

    public static function getYears(){
        $current = Carbon::now()->year;
        $max_revers = -100;
        $years = [];
        $i = 0;
        while($max_revers < $i){
            $i-=1;
            array_push($years, $current + $i);
        }
        
        return $years;
    }


    /**
     * Check if birth date is valid.
     */
    public static function checkBirthDate($data){
        try{
            $date = Carbon::parse($data['birth_day'].'.'.$data['birth_month'].'.'.$data['birth_year']);
            return true;
        } catch(Exception $e){
            return false;
        }
    }

}