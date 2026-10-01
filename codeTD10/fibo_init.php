<?php

session_start();

$val1 = (int)($_GET['v1'] ?? 0);
$val2 = (int)($_GET['v2'] ?? 1);

$_SESSION['fibo'] = [$val1, $val2];

echo "Suite de Fibonacci initialisée avec $val1 et $val2.<br>";