<?php

session_start();

$_SESSION['playlist'] = new Playlist("Ma Playlist");

echo "playlist initialisé .<br>";