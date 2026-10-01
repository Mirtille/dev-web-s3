<?php

if (isset($_COOKIE['compteur'])) {
    $compteur = $_COOKIE['compteur'] + 1;
} else {
    $compteur = 1;
}

setcookie('compteur', $compteur, time() + 3600 * 2, '/');

echo "Nombre de visites : " . $compteur;