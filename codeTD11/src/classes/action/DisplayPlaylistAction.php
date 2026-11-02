<?php

namespace iutnc\deefy\action;

use iutnc\deefy\render\AudioListRenderer;

class DisplayPlaylistAction extends Action {
    public function execute(): string {
        if (!isset($_SESSION['playlist'])) {
            return "<p>Aucune playlist n'a encore été créée en session.</p>";
        }

        $renderer = new AudioListRenderer($_SESSION['playlist']);
        return $renderer->render(1);
    }
}