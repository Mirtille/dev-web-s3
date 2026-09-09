<?php

require_once 'AlbumTrack.php';
require_once 'Renderer.php';

class AlbumTrackRenderer implements Renderer{

private AlbumTrack $album;

public function __construct(AlbumTrack $album){
    $this->album = $album;
}

public function render(int $selector): string{
    switch ($selector){
        case self::Compact:
            return $this -> renderCompact;
        case self::Long:
            return $this -> renderLong;
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
               "<p>Genre : {$this->track->genre} | Durée : {$this->track->duree} s</p>" .
               "<audio controls src='{$this->track->fichierAudio}'></audio>" .
               "</div>";
    }
}