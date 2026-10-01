<?php

session_start();

$val = isset($_GET['val']) ? (int)$_GET['val'] : 1;

if(isset($_SESSION['sess_counter'])){
    $_SESSION['sess_counter'] += $val;
    echo "compteur : " . $_SESSION['sess_counter'] . '<br>';
    
} else {
    $_SESSION['sess_counter'] = 1;
    echo "initialisation du compteur : " . $val . "<br>";
}