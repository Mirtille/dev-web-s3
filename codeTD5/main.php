<?php

require_once 'AlbumTrack.php';
require_once 'AlbumTrackRenderer.php';
require_once 'PodcastTrack.php';
require_once 'PodcastRenderer.php';


$t1 = new AlbumTrack("Thriller", "audio/thriller.mp3", "Thriller", 4);
$t1->artiste = "Michael Jackson";
$t1->genre = "Pop";
$t1->annee = 1982;
$t1->duree = 357;

$t2 = new AlbumTrack("Billie Jean", "audio/billie_jean.mp3", "Thriller", 6);
$t2->artiste = "Michael Jackson";
$t2->genre = "Pop";
$t2->annee = 1982;
$t2->duree = 294;

echo "Titre t1 : " . $t1->titre . "<br>\n";
print "Artiste t1 : " . $t1->artiste . "<br>\n";
printf("Piste n°%d : %s (%s, %d) - %d s<br>\n", $t1->numero, $t1->titre, $t1->album, $t1->annee, $t1->duree);

echo "<br>\n";

echo "Appel explicite : " . $t1->__toString() . "<br>\n";
echo "Appel implicite : " . $t1 . "<br>\n";

echo "<br>\n";

echo "<pre>";
print_r($t1);
echo "</pre>";

echo "<pre>";
var_dump($t1);
echo "</pre>";


$renderer = new AlbumTrackRenderer($t1);

echo "<h3>Mode compact :</h3>";
echo $renderer->render(1);

echo "<h3>Mode long :</h3>";
echo $renderer->render(2);


$podcast = new PodcastTrack("Culture Numérique #1", "audio/podcast1.mp3");
$podcast->auteur = "Alice Martin";
$podcast->date = "2026-09-09";
$podcast->genre = "Tech";
$podcast->duree = 1420;

echo "<h3>Podcast créé :</h3>";
echo $podcast;



$podcastRenderer = new PodcastRenderer($podcast);

echo "<h3>Podcast - Mode compact :</h3>";
echo $podcastRenderer->render(Renderer::COMPACT);

echo "<h3>Podcast - Mode long :</h3>";
echo $podcastRenderer->render(Renderer::LONG);