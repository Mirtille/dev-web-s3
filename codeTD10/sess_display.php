<?php
session_start();

echo "Valeur du compteur : " . ($_SESSION['sess_counter'] ?? 'non initialisé');