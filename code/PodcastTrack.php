<?php

class PodcastTrack extends AudioTrack {
    public string $auteur;
    public string $date;

    public function __construct(string $titre, string $chemin) {
        parent::__construct($titre, $chemin);
    }
}