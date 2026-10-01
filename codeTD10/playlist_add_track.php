<?php


require_once 'vendor/autoload.php';

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack;

session_start();

if(!isset($_SESSION['playlist'])){
    echo "la playlist n'existe pas";
} else {
    $piste = new AlbumTrack("Bohemian Rhapsody", "bohemian.mp3", "A Night at the Opera", 4);
    $piste->setArtiste("Queen");
    $_SESSION['playlist']->addTrackList($piste);
    echo "Piste ajoutée à la playlist en session !<br>";
}