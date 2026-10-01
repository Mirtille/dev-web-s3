<?php

require_once 'vendor/autoload.php';

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\render\AlbumTrackRenderer;

if(isset($_COOKIE['track'])){
    $track = unserialize($_COOKIE['track']);
    $renderer = new AlbumTrackRenderer($track);
    echo $renderer->render(1);
} else {
    $track = new AlbumTrack("Bohemian Rhapsody", "bohemian.mp3", "A Night at the Opera", 4);
    $track->setArtiste("Queen");
    $str = serialize($track);
    setcookie("track", $str, time() + 3600 * 2);
    echo "Piste créée et mise en cookie";
}