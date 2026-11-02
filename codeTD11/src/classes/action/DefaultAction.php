<?php

namespace iutnc\deefy\action;

class DefaultAction extends Action {
    public function execute(): string {
        return "<h2>Bienvenue sur Deefy !</h2><p>Sélectionnez une action pour commencer.</p>";
    }
}