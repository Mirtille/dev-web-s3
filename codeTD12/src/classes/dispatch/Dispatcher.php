<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\Action;
use iutnc\deefy\action\DefaultAction;

class Dispatcher {
    private string $action;
    private array $routes = [];

    public function __construct() {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function addRoute(string $action, string $class): self {
        $this->routes[$action] = $class;
        return $this;
    }

    public function run(): void {
        // Si l'action est enregistrée dans les routes, on instancie la classe correspondante
        if (isset($this->routes[$this->action])) {
            $class = $this->routes[$this->action];
            $act = new $class();
        } else {
            // Repli sur l'action par défaut
            $act = new DefaultAction();
        }

        $html = $act->execute();
        $this->renderPage($html);
    }

    private function renderPage(string $html): void {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Deefy</title>
        </head>
        <body>
            <header>
                <h1>Deefy App</h1>
                <nav>
                    <a href="?action=default">Accueil</a> |
                    <a href="?action=playlist">Voir Playlist</a> |
                    <a href="?action=add-playlist">Créer Playlist</a> |
                    <a href="?action=add-user">Inscription</a>
                </nav>
                <hr>
            </header>
            <main>
                $html
            </main>
        </body>
        </html>
        HTML;
    }
}