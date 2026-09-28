<?php

require_once 'src/loader/Psr4ClassLoader.php';

//$loader = new \loader\Psr4ClassLoader("iutnc\\deefy\\", "src/classes");
//$loader->register();

require_once 'vendor/autoload.php';

use iutnc\deefy\render\RendererFactory;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\Playlist;

// 1. Création des pistes
$t1 = new AlbumTrack("Thriller", "audio/thriller.mp3", "Thriller", 4);
$t1->setArtiste("Michael Jackson");
$t1->setGenre(AudioTrack::POP);
$t1->setAnnee(1982);
$t1->setDuree(357);

$t2 = new AlbumTrack("Billie Jean", "audio/billie_jean.mp3", "Thriller", 6);
$t2->setArtiste("Michael Jackson");
$t2->setGenre(AudioTrack::FUNK);
$t2->setAnnee(1982);
$t2->setDuree(294);

$podcast = new PodcastTrack("Culture Numérique #1", "audio/podcast1.mp3");
$podcast->setAuteur("Alice Martin");
$podcast->setDate("2026-09-09");
$podcast->setGenre(AudioTrack::POP);
$podcast->setDuree(1420);

// 2. Création et alimentation de la playlist
$maPlaylist = new Playlist("Ma super playlist");
$maPlaylist->addTrack($t1);
$maPlaylist->addTrack($t2);
$maPlaylist->addTrack($podcast);

// 3. Test de l'exercice 1 (Iterator)
echo "=== Test Iterator ===\n";
foreach ($maPlaylist as $track) {
    echo "- " . $track->titre . "\n";
}

// 4. Test de l'exercice 2 (Factory)
echo "\n=== Test RendererFactory ===\n";
$rendu = RendererFactory::getRenderer($maPlaylist);
echo $rendu->render();

// 5. Test de l'exercice 3 (Genres ID3)
echo "\n=== Test Genres ID3 ===\n";
echo "Genre de t2 : " . AudioTrack::getGenreAsString($t2->genre) . "\n";
if ($t2->genre === AudioTrack::POLKA) {
    echo "bof, pas mon truc\n";
} else {
    echo "Genre validé : " . AudioTrack::getGenreAsString($t2->genre) . "\n";
}