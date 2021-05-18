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
        $current = Carbon::now()->year - 17;
        $max_revers = -100;
        $years = [];
        $i = 0;
        while($max_revers < $i){
            $i-=1;
            array_push($years, $current + $i);
        }

        return $years;
    }

    public static function getDates(){
        $current = Carbon::now()->year - 17;
        $max_revers = -100;
        $years = [];
        $i = 0;
        while($max_revers < $i){
            $i-=1;
            array_push($years, $current + $i);
        }

        $dates = [];

        $count = 0;
        foreach($years as $year){
            $dates[$count]['year'] = $year;
            for($month = 1; $month <= 12; $month++){
                $totalDays = Carbon::parse('1.'.$month.'.'.$year)->daysInMonth;
                $allDays = [];
                for($day = 1; $day<= $totalDays; $day++){
                    array_push($allDays, $day);
                }
                $dates[$count]['months'][$month]['days'] = $allDays;
            }
            $count++;
        }
        
        return json_encode($dates);
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