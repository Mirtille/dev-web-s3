<?php
namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;

class PodcastRenderer implements Renderer {
    private PodcastTrack $podcast;

    public function __construct(PodcastTrack $podcast) {
        $this->podcast = $podcast;
    }

    public function render(int $selector): string {
        switch ($selector) {
            case self::COMPACT:
                return $this->renderCompact();
            case self::LONG:
                return $this->renderLong();
            default:
                return "<p>Mode d'affichage inconnu.</p>";
        }
    }

    private function renderCompact(): string {
        return "<div class='podcast-compact'>" .
               "<span>{$this->podcast->titre} - {$this->podcast->auteur}</span>" .
               "<audio controls src='{$this->podcast->fichierAudio}'></audio>" .
               "</div>";
    }

    private function renderLong(): string {
        return "<div class='podcast-long'>" .
               "<h2>{$this->podcast->titre}</h2>" .
               "<p>Auteur : {$this->podcast->auteur} ({$this->podcast->date})</p>" .
               "<p>Genre : {$this->podcast->genre} | Durée : {$this->podcast->duree} s</p>" .
               "<audio controls src='{$this->podcast->fichierAudio}'></audio>" .
               "</div>";
    }
}