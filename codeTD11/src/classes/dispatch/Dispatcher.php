<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;

class Dispatcher {
    private string $action;[cite: 1, 3]

    public function __construct() {
        // Si ?action=... n'est pas renseigné, on charge 'default'
        $this->action = $_GET['action'] ?? 'default';[cite: 1, 3]
    }

    public function run(): void {
        // 1. Sélection de l'action selon la valeur du paramètre
        switch ($this->action) {
            case 'playlist':
                $act = new DisplayPlaylistAction();[cite: 1, 3]
                break;
            case 'add-playlist':
                $act = new AddPlaylistAction();[cite: 1, 3]
                break;
            case 'add-track':
                $act = new AddPodcastTrackAction();[cite: 1, 3]
                break;
            case 'default':
            default:
                $act = new DefaultAction();[cite: 1, 3]
                break;
        }

        // 2. Exécution de l'action pour récupérer le fragment HTML
        $html = $act->execute();[cite: 1, 2, 3, 4]

        // 3. Transmission du fragment à la méthode d'affichage
        $this->renderPage($html);[cite: 2, 4]
    }

    private function renderPage(string $html): void {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Deefy App</title>
        </head>
        <body>
            <header>
                <h1>Deefy Music</h1>
                <nav>
                    <a href="?action=default">Accueil</a> |
                    <a href="?action=playlist">Voir la Playlist</a> |
                    <a href="?action=add-playlist">Créer Playlist</a> |
                    <a href="?action=add-track">Ajouter Track</a>
                </nav>
                <hr>
            </header>
            <main>
                $html
            </main>
            <footer>
                <hr>
                <p><small>&copy; Deefy App - BUT Informatique</small></p>
            </footer>
        </body>
        </html>
        HTML;
    }
}