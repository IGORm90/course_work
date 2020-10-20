<?php

namespace application\lib;

class Recomendation {




    function __construct(){
        //
    }

    public function simPearson($person1, $person2){

        $si1 = array_intersect_key($person1, $person2);
        $si2 = array_intersect_key($person2, $person1);

        $n = count($si1);
        if(count($n) == 0){
            return 0;
        }

        
        $sum1 = array_sum($si1);
        $sum2 = array_sum($si2);


        $sum1Sq = 0;
        $sum2Sq = 0;
        foreach($si1 as $val){
            $sum1Sq += pow($val, 2);
        }
        foreach($si2 as $val){
            $sum2Sq += pow($val, 2);
        }


        $pSum = 0;
        for($i = 0; $i < count($si1); $i++){
            $pSum += $si1[$i] * $si2[$i];
        }

        $num = $pSum - ($sum1*$sum2/$n);
        $den = sqrt($sum1Sq-pow($sum1,2))*($sum2Sq-pow($sum2,2));
        return ($den == 0) ? 0 : $num/$den;

    }

    

}