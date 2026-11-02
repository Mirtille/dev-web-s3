<?php

namespace iutnc\deefy\action;

class AddUserAction extends Action {
    public function execute(): string {
        if ($this->http_method === 'GET') {
            return <<<HTML
            <form method="post" action="?action=add-user">
                <div>
                    <label>Nom : <input type="text" name="nom" required></label>
                </div>
                <div>
                    <label>Email : <input type="email" name="email" required></label>
                </div>
                <div>
                    <label>Âge : <input type="number" name="age" min="1" max="120" required></label>
                </div>
                <div>
                    <button type="submit">Connexion</button>
                </div>
            </form>
            HTML;
        }

        // Requête POST : filtrage anti-XSS et validation
        $nom = filter_var($_POST['nom'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $age = filter_var($_POST['age'] ?? '', FILTER_SANITIZE_NUMBER_INT);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<p>Format d'email invalide.</p>";
        }

        return "<p>Nom: {$nom}, Email: {$email}, Age: {$age} ans</p>";
    }
}