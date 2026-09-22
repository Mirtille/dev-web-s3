<?php

require_once 'AlbumTrack.php';
require_once 'AlbumTrackRenderer.php';
require_once 'PodcastTrack.php';
require_once 'PodcastRenderer.php';


$t1 = new AlbumTrack("Thriller", "audio/thriller.mp3", "Thriller", 4);
$t1->setArtiste("Michael Jackson");
$t1->setGenre("Pop");
$t1->setAnnee(1982);
$t1->setDuree(357);

$t2 = new AlbumTrack("Billie Jean", "audio/billie_jean.mp3", "Thriller", 6);
$t2->setArtiste("Michael Jackson");
$t2->setGenre("Pop");
$t2->setAnnee(1982);
$t2->setDuree(294);

/*
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
*/

$renderer = new AlbumTrackRenderer($t1);

/*
echo "<h3>Mode compact :</h3>";
echo $renderer->render(1);

echo "<h3>Mode long :</h3>";
echo $renderer->render(2);

*/
$podcast = new PodcastTrack("Culture Numérique #1", "audio/podcast1.mp3");
$podcast->setAuteur("Alice Martin");
$podcast->setDate("2026-09-09");
$podcast->setGenre("Tech");
$podcast->setDuree(1420);
/*
echo "<h3>Podcast créé :</h3>";
echo $podcast;
*/


$podcastRenderer = new PodcastRenderer($podcast);

/*
echo "<h3>Podcast - Mode compact :</h3>";
echo $podcastRenderer->render(Renderer::COMPACT);

echo "<h3>Podcast - Mode long :</h3>";
echo $podcastRenderer->render(Renderer::LONG);
*/

try {
    $piste = new AudioTrack("Test", "audio/test.mp3");
    
    $piste->setDuree(-10);


} catch (InvalidPropertyNameException | InvalidPropertyValueException $e) {
    echo "<strong>Erreur :</strong> " . $e->getMessage() . "<br>\n";
    echo "<strong>Trace :</strong><pre>" . $e->getTraceAsString() . "</pre>";
}