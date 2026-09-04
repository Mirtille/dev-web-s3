<?php

function plus_grand(int|float $nombre1, int|float $nombre2){
    if ($nombre1 > $nombre2){
        return $nombre1;
    } else{
        return $nombre2;
    }
}

//echo plus_grand(10, 5);

function entier(int $max, int $div = 2){
    while($max >= 0){
        echo $max . "\n";
        if($max % $div == 0){
            echo " est divisible par $div \n";
        }
        $max--;
    }
}

//echo entier(10);


//echo entier(10);

function carre(int|float $x, int $n){
    $res = 1;
    while($n > 0){
        $res = $res * $x; 
        $n--;
    }
    return $res;
}

echo carre(2, 3);