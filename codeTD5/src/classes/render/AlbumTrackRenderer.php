<?php
namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\tracks\AudioTrack;

class AlbumTrackRenderer implements Renderer {

    protected AlbumTrack $track;

    public function __construct(AlbumTrack $track) {
        $this->track = $track;
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
        return "<div class='track-compact'>" .
               "<span>{$this->track->titre} - {$this->track->artiste} ({$this->track->album})</span>" .
               "<audio controls src='{$this->track->fichierAudio}'></audio>" .
               "</div>";
    }

    private function renderLong(): string {
        return "<div class='track-long'>" .
               "<h2>{$this->track->numero}. {$this->track->titre}</h2>" .
               "<p>Artiste : {$this->track->artiste}</p>" .
               "<p>Album : {$this->track->album} ({$this->track->annee})</p>" .
               "<p>Genre : " . AudioTrack::getGenreAsString($this->track->genre) . " | Durée : {$this->track->duree} s</p>" .
               "<audio controls src='{$this->track->fichierAudio}'></audio>" .
               "</div>";
    }
}