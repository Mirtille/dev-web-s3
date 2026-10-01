<?php

require_once 'vendor/autoload.php';

use iutnc\deefy\render\AudioListRenderer;

session_start();

if(!isset($_SESSION['playlist'])){
    echo "la playlist n'existe pas";
} else {
    $renderer = new AudioListRenderer($_SESSION['playlist']);
    echo $renderer->render(1);
}