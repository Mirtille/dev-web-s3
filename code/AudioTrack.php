<?php

class AudioTrack {
    public string $titre;
    public string $genre;
    public int $duree;
    public string $fichierAudio;

    public function __construct(string $titre, string $chemin) {
        $this->titre = $titre;
        $this->fichierAudio = $chemin;
    }

    public function __toString(): string {
        return json_encode(get_object_vars($this));
    }
}