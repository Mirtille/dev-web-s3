<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;

class AddPlaylistAction extends Action {
    public function execute(): string {
        $_SESSION['playlist'] = new Playlist("Ma Playlist Deefy");
        return "<p>La playlist <strong>Ma Playlist Deefy</strong> a été créée avec succès en session !</p>";
    }
}