<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\render\AudioListRenderer;

class AddPlaylistAction extends Action {
    public function execute(): string {
        if ($this->http_method === 'GET') {
            return <<<HTML
            <form method="post" action="?action=add-playlist">
                <label>Nom de la playlist : 
                    <input type="text" name="nom" required placeholder="Ex: Mes favoris">
                </label>
                <button type="submit">Créer</button>
            </form>
            HTML;
        }

        // Requête POST
        $nom = filter_var($_POST['nom'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($nom)) {
            return "<p>Erreur : le nom de la playlist ne peut pas être vide.</p>";
        }

        $playlist = new Playlist($nom);
        $_SESSION['playlist'] = $playlist;

        $renderer = new AudioListRenderer($playlist);
        $html = $renderer->render(1);
        $html .= '<p><a href="?action=add-track">Ajouter une piste</a></p>';

        return $html;
    }
}