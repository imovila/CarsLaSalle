<?php

class Sorting{
  
    public static function sortAsc(&$carsarray, $filter){
        usort($carsarray, function($arr1, $arr2) use ($filter) {
                return ($arr1[$filter] < $arr2[$filter]) ? -1 : 1;
             });
    }
    
    public static function sortDesc(&$carsarray, $filter){
        usort($carsarray, function($arr1, $arr2) use ($filter) {
            return ($arr1[$filter] < $arr2[$filter]) ? 1 : -1;
        });
    }

}

?>