<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;

class AddPodcastTrackAction extends Action {
    public function execute(): string {
        if (!isset($_SESSION['playlist'])) {
            return "<p>Veuillez d'abord <a href='?action=add-playlist'>créer une playlist</a> avant d'ajouter des pistes.</p>";
        }

        if ($this->http_method === 'GET') {
            return <<<HTML
            <form method="post" action="?action=add-track" enctype="multipart/form-data">
                <div>
                    <label>Titre : <input type="text" name="titre" required></label>
                </div>
                <div>
                    <label>Auteur : <input type="text" name="auteur"></label>
                </div>
                <div>
                    <label>Date : <input type="date" name="date"></label>
                </div>
                <div>
                    <label>Fichier audio (.mp3) : <input type="file" name="userfile" required accept=".mp3,audio/mpeg"></label>
                </div>
                <div>
                    <button type="submit">Ajouter la piste</button>
                </div>
            </form>
            HTML;
        }

        // Requête POST
        $titre = filter_var($_POST['titre'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $auteur = filter_var($_POST['auteur'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_var($_POST['date'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Vérification de l'upload du fichier audio
        if (!isset($_FILES['userfile']) || $_FILES['userfile']['error'] !== UPLOAD_ERR_OK) {
            return "<p>Erreur lors du téléchargement du fichier audio.</p>";
        }

        $originalName = $_FILES['userfile']['name'];
        $mimeType = $_FILES['userfile']['type'];

        // Contrôles de sécurité demandés dans le sujet
        if (substr($originalName, -4) !== '.mp3' || str_ends_with($originalName, '.php')) {
            return "<p>Erreur : seul le format .mp3 est autorisé (fichiers .php strictement interdits).</p>";
        }

        // Sauvegarde dans /audio avec un nom unique
        $uniqueFilename = uniqid('track_', true) . '.mp3';
        $destPath = __DIR__ . '/../../../audio/' . $uniqueFilename;

        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $destPath)) {
            return "<p>Échec de l'enregistrement du fichier sur le serveur.</p>";
        }

        // Instanciation de la piste
        $track = new PodcastTrack($titre, $uniqueFilename);
        if (method_exists($track, 'setAuteur')) $track->setAuteur($auteur);
        if (method_exists($track, 'setDate')) $track->setDate($date);

        // Ajout à la playlist en session
        $_SESSION['playlist']->addTrackList($track);

        $renderer = new AudioListRenderer($_SESSION['playlist']);
        $html = $renderer->render(1);
        $html .= '<p><a href="?action=add-track">Ajouter encore une piste</a></p>';

        return $html;
    }
}