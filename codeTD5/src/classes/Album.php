<?php
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\exception\InvalidPropertyNameException;

require_once 'AudioList.php';

class Album extends AudioList {
    protected string $artiste = "";
    protected string $dateSortie = "";

    public function __construct(string $nom, array $pistes) {
        parent::__construct($nom, $pistes);
    }

    public function setArtiste(string $artiste): void {
        $this->artiste = $artiste;
    }

    public function setDateSortie(string $dateSortie): void {
        $this->dateSortie = $dateSortie;
    }
}