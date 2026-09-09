<?php

require_once 'AudioTrack.php';

class AlbumTrack extends AudioTrack{
    public string $titre, $artiste, $album, $genre, $fichierAudio;
    public int $numPiste, $annee, $duree;

    public function __construct(string $titre, string $fichierAudio, string $album, int $numPiste){
        parent::__construct($titre, $fichierAudio);
        $this->album = $album;
        $this->numPiste = $numPiste;
    }

    public function __toString(): string{
        return json_encode(get_object_vars($this));
    }
}