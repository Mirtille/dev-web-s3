<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack; // ou AlbumTrack si tu n'as pas encore créé PodcastTrack

class AddPodcastTrackAction extends Action {
    public function execute(): string {
        if (!isset($_SESSION['playlist'])) {
            return "<p>Erreur : impossible d'ajouter une piste, aucune playlist n'existe en session.</p>";
        }

        // Instanciation de la piste
        $track = new PodcastTrack("Épisode 1", "podcast1.mp3");
        $track->setAuteur("Mon Podcasteur");
        $track->setDate("2026-10-07");

        $_SESSION['playlist']->addTrackList($track);

        return "<p>La piste <em>" . $track->titre . "</em> a été ajoutée à la playlist en session !</p>";
    }
}