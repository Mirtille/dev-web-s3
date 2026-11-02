<?php

namespace iutnc\deefy\repository;

use PDO;
use Exception;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class DeefyRepository {
    private PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [];

    // Constructeur privé (Singleton)[cite: 45]
    private function __construct(array $conf) {
        $dsn = "{$conf['driver']}:host={$conf['host']};dbname={$conf['database']};charset=utf8";
        $this->pdo = new PDO($dsn, $conf['username'], $conf['password'], [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);
    }

    // Chargement de la config depuis le fichier .ini[cite: 38, 45, 47]
    public static function setConfig(string $file): void {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new Exception("Impossible de lire le fichier de configuration : $file");
        }
        self::$config = $conf;
    }

    // Récupération de l'instance unique
    public static function getInstance(): DeefyRepository {
        if (is_null(self::$instance)) {
            if (empty(self::$config)) {
                throw new Exception("La configuration de la base de données n'a pas été initialisée.");
            }
            self::$instance = new DeefyRepository(self::$config);
        }
        return self::$instance;
    }

    // 1. Récupérer toutes les playlists (sans leurs pistes)
    public function findAllPlaylists(): array {
        $stmt = $this->pdo->query("SELECT id, nom FROM playlist");
        $playlists = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pl = new Playlist($row['nom']);
            $pl->setId((int)$row['id']);
            $playlists[] = $pl;
        }
        return $playlists;
    }

    // 2. Sauvegarder une playlist vide[cite: 45, 46, 47]
    public function saveEmptyPlaylist(Playlist $pl): Playlist {
        $stmt = $this->pdo->prepare("INSERT INTO playlist (nom) VALUES (:nom)");
        $stmt->execute(['nom' => $pl->nom ?? $pl->nom]);
        $pl->setId((int)$this->pdo->lastInsertId());
        return $pl;
    }

    // 3. Sauvegarder une piste (gère AlbumTrack et PodcastTrack selon les colonnes de la table)[cite: 41, 47]
    public function saveTrack(AudioTrack $tr): AudioTrack {
        $sql = "INSERT INTO track (titre, genre, duree, filename, type, artiste_album, titre_album, annee_album, numero_album, auteur_podcast, date_posdcast) 
                VALUES (:titre, :genre, :duree, :filename, :type, :artiste, :titre_album, :annee, :numero, :auteur, :date_pod)";
        
        $stmt = $this->pdo->prepare($sql);

        $isAlbum = ($tr instanceof AlbumTrack);
        $isPodcast = ($tr instanceof PodcastTrack);

        $stmt->execute([
            'titre' => $tr->titre,
            'genre' => $tr->genre ?? null,
            'duree' => $tr->duree ?? 0,
            'filename' => $tr->nomFichier ?? ($tr->filename ?? ''),
            'type' => $isAlbum ? 'A' : ($isPodcast ? 'P' : null),
            'artiste' => $isAlbum ? ($tr->artiste ?? null) : null,
            'titre_album' => $isAlbum ? ($tr->album ?? null) : null,
            'annee' => $isAlbum ? ($tr->annee ?? null) : null,
            'numero' => $isAlbum ? ($tr->numeroPiste ?? null) : null,
            'auteur' => $isPodcast ? ($tr->auteur ?? null) : null,
            'date_pod' => $isPodcast ? ($tr->date ?? null) : null,
        ]);

        $tr->setId((int)$this->pdo->lastInsertId());
        return $tr;
    }

    // 4. Associer une piste existante à une playlist existante[cite: 47]
    public function addTrackToPlaylist(int $idTrack, int $idPlaylist): void {
        // Trouver le numéro de la prochaine piste dans la playlist
        $queryNum = "SELECT COALESCE(MAX(no_piste_dans_liste), 0) + 1 AS next_num 
                     FROM playlist2track 
                     WHERE id_pl = :id_pl";
        $stmtNum = $this->pdo->prepare($queryNum);
        $stmtNum->execute(['id_pl' => $idPlaylist]);
        $nextNum = (int)$stmtNum->fetch(PDO::FETCH_ASSOC)['next_num'];

        // Insertion dans la table de liaison Many-to-Many[cite: 47]
        $insert = "INSERT INTO playlist2track (id_pl, id_track, no_piste_dans_liste) 
                   VALUES (:id_pl, :id_track, :no_piste)";
        $stmtInsert = $this->pdo->prepare($insert);
        $stmtInsert->execute([
            'id_pl' => $idPlaylist,
            'id_track' => $idTrack,
            'no_piste' => $nextNum
        ]);
    }
}