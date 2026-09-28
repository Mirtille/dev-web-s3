<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;
use \Exception;

class RendererFactory {

    public static function getRenderer(mixed $instance): Renderer {
        if ($instance instanceof AlbumTrack) {
            return new AlbumTrackRenderer($instance);
        }

        if ($instance instanceof PodcastTrack) {
            return new PodcastRenderer($instance);
        }

        if ($instance instanceof AudioList) {
            return new AudioListRenderer($instance);
        }

        throw new Exception("Type d'objet non pris en charge pour le rendu.");
    }
}