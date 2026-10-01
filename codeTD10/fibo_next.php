<?php

session_start();

if (!isset($_SESSION['fibo']) || count($_SESSION['fibo']) < 2) {
    echo "La suite n'a pas encore été initialisée.<br>";
    exit;
}

$n = count($_SESSION['fibo']);

$u1 = $_SESSION['fibo'][$n - 2];
$u2 = $_SESSION['fibo'][$n - 1];

$next = $u1 + $u2;

$_SESSION['fibo'][] = $next;

echo "Valeur courante : " . $next . "<br>";