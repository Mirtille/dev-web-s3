<?php

session_start();

if (!isset($_SESSION['fibo']) || count($_SESSION['fibo']) < 2){
    echo "La suite n'a pas encore été initialisée.<br>";
    exit;
}

foreach($_SESSION['fibo'] as $value){
    echo "Valeur courante de fibo : $value.<br>";
}