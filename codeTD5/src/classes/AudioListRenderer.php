<?php
namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;

require_once 'Renderer.php';
require_once 'AudioList.php';
require_once 'AlbumTrack.php';
require_once 'AlbumTrackRenderer.php';
require_once 'PodcastTrack.php';
require_once 'PodcastRenderer.php';

class AudioListRenderer implements Renderer {
    private AudioList $audioList;

    public function __construct(AudioList $audioList) {
        $this->audioList = $audioList;
    }

    public function render(int $selector = 0): string {
        $html = "<div class='audio-list'>\n";
        $html .= "  <h2>Liste : {$this->audioList->nom}</h2>\n";
        $html .= "  <div class='tracks'>\n";

        foreach ($this->audioList->pistes as $piste) {
            if ($piste instanceof AlbumTrack) {
                $renderer = new AlbumTrackRenderer($piste);
            } elseif ($piste instanceof PodcastTrack) {
                $renderer = new PodcastRenderer($piste);
            } else {
                continue;
            }
            $html .= $renderer->render(Renderer::COMPACT);
        }

        $html .= "  </div>\n";
        $html .= "  <p>Total : {$this->audioList->nbPistes} pistes | Durée totale : {$this->audioList->dureeTotale} s</p>\n";
        $html .= "</div>\n";

        return $html;
    }
}