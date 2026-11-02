<?php

require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\AddUserAction;

session_start();

// Initialisation de la configuration BDD (une seule fois pour toute l'app)[cite: 45, 47]
DeefyRepository::setConfig(__DIR__ . '/config.db.ini');

$dispatcher = new Dispatcher();

$dispatcher->addRoute('default', DefaultAction::class)
           ->addRoute('playlist', DisplayPlaylistAction::class)
           ->addRoute('add-playlist', AddPlaylistAction::class)
           ->addRoute('add-track', AddPodcastTrackAction::class)
           ->addRoute('add-user', AddUserAction::class);

$dispatcher->run();