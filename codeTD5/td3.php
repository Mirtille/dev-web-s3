<?php

$playlist = [
"nom" => "test",
"genre" => "dsbm",
"createur" => "milka",
"date" => "08/09/2026",
"nbpistes" => 10,
"duree" => 1000
];

$piste1 = [
    "titre" => "my funny valentine",
    "artiste" => "chet baker",
    "album" => "My Funny Valentine",
    "annee" => 1954,
    "genre" => "classic jazz",
    "numero" => 1,
    "duree" => 187
];

$piste2 = [
    "titre" => "Gimme Shelter",
    "artiste" => "The Rolling Stones",
    "album" => "Let it Bleed",
    "annee" => 1969,
    "genre" => "rock",
    "numero" => 1,
    "duree" => 271
];

$piste3 = [
    "titre" => "Whole Lotta Love",
    "artiste" => "Led Zeppelin",
    "album" => "Led Zeppelin II",
    "annee" => 1969,
    "genre" => "rock",
    "numero" => 1,
    "duree" => 334
];

function display(array $playlist): void {
    echo "playlist: {$playlist['nom']} ({$playlist['genre']})\n" .
         "par {$playlist['createur']} le {$playlist['date']}\n" .
         "{$playlist['nbpistes']} pistes pour une durée totale {$playlist['duree']} s\n";

    if (!empty($playlist['pistes'])) {
        foreach ($playlist['pistes'] as $index => $piste) {
            $num = $index + 1;
            echo "$num- ";
            display_track($piste, 'court');
        }
    }
}

function display_track($piste, $mode = 'court'){
    switch ($mode){
        case "court":
            echo "{$piste['titre']} - by {$piste['artiste']} ({$piste['album']})";
            break;
        case "complet":
            echo "{$piste['numero']}-{$piste['titre']} - {$piste['artiste']} ({$piste['album']}) -{$piste['duree']}s";
            break;
        case "étendu":
            echo "{$piste['numero']}-{$piste['titre']} - by {$piste['artiste']} (from {$piste['album']}, {$piste['annee']} ) - {$piste['duree']}s : {$piste['genre']}";            
            break;
    }
}

function play_track(array $piste) {
    echo "{$piste['titre']}\n";
    for ($i = 1; $i <= $piste['duree']; $i++) {
        echo $i . ".";
    }
    echo "\n";
}

function add_track(array $playlist, array $piste): array {
    if (!isset($playlist['pistes'])) {
        $playlist['pistes'] = [];
        $playlist['nbpistes'] = 0;
        $playlist['duree'] = 0;
    }

    $playlist['pistes'][] = $piste;
    $playlist['nbpistes']++;
    $playlist['duree'] += $piste['duree'];

    return $playlist;
}

function play(array $playlist): void {
    if (!empty($playlist['pistes'])) {
        foreach ($playlist['pistes'] as $piste) {
            play_track($piste);
        }
    }
}

function remove_track(array $playlist, int $numero): array {
    $index = $numero - 1;

    if (isset($playlist['pistes'][$index])) {
        $playlist['duree'] -= $playlist['pistes'][$index]['duree'];
        $playlist['nbpistes']--;
        array_splice($playlist['pistes'], $index, 1);
    }

    return $playlist;
}

function pl_shuffle(array $playlist): array {
    if (!empty($playlist['pistes'])) {
        shuffle($playlist['pistes']);
    }

    return $playlist;
}

// Initialisation
$playlist = [
    "nom" => "my personnal best of",
    "genre" => "rock",
    "createur" => "john doe",
    "date" => "28-08-2022",
    "nbpistes" => 0,
    "duree" => 0,
    "pistes" => []
];