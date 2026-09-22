<?php
namespace iutnc\deefy\audio\tracks;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

require_once 'InvalidPropertyNameException.php';
require_once 'InvalidPropertyValueException.php';

class AudioTrack {
    protected string $titre;
    protected string $genre;
    protected int $duree;
    protected string $fichierAudio;

    public function __construct(string $titre, string $chemin) {
        $this->titre = $titre;
        $this->fichierAudio = $chemin;
    }

    public function __toString(): string {
        return json_encode(get_object_vars($this));
    }

    public function __get(string $attrname): mixed {
        if (property_exists($this, $attrname)) {
            return $this->$attrname;
        }
        throw new InvalidPropertyNameException("invalid property: " . $attrname);
    }

    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    public function setDuree(int $duree): void {   
        if ($duree <= 0) {
            throw new InvalidPropertyValueException("Durée invalide : " . $duree . " (doit être > 0)");
        }
        $this->duree = $duree;
    }
}