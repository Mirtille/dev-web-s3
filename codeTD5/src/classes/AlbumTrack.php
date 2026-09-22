<?php
namespace iutnc\deefy\audio\tracks;

require_once 'AudioTrack.php';

class AlbumTrack extends AudioTrack{
    protected string $artiste;
    protected string $album;
    protected int $numPiste;
    protected int $annee;

    public function __construct(string $titre, string $fichierAudio, string $album, int $numPiste){
        parent::__construct($titre, $fichierAudio);
        $this->album = $album;
        $this->numPiste = $numPiste;
    }

    public function __toString(): string{
        return json_encode(get_object_vars($this));
    }

    public function setArtiste(string $artiste): void {
        $this->artiste = $artiste;
    }

    public function setAnnee(int $annee): void {
        $this->annee = $annee;
    }
}