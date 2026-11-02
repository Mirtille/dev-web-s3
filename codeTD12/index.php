<?php

require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\AddUserAction;

session_start();

$dispatcher = new Dispatcher();

$dispatcher->addRoute('default', DefaultAction::class)
           ->addRoute('playlist', DisplayPlaylistAction::class)
           ->addRoute('add-playlist', AddPlaylistAction::class)
           ->addRoute('add-track', AddPodcastTrackAction::class)
           ->addRoute('add-user', AddUserAction::class);

$dispatcher->run();