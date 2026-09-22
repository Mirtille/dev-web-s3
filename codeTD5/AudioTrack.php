<?php

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
        throw new Exception("invalid property: " . $attrname);
    }

    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    public function setDuree(int $duree): void {
        $this->duree = $duree;
    }
}