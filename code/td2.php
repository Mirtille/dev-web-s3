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

//echo carre(2, 3);

function routeur($choix, $p1, $p2) {
    switch ($choix) {
        case 1:
            if (is_numeric($p1) && is_numeric($p2)) {
                return plus_grand($p1, $p2);
            }
            break;
        case 2:
            if (is_int($p1) && is_int($p2)) {
                entier($p1, $p2);
            }
            break;
        case 3:
            if (is_numeric($p1) && is_int($p2)) {
                return puissance($p1, $p2);
            }
            break;
    }
}

echo routeur(1, 10, 42.5);