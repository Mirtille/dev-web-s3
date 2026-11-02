<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AudioTrack {
    public const BLUES = 0;
    public const CLASSIC_ROCK = 1;
    public const COUNTRY = 2;
    public const DANCE = 3;
    public const DISCO = 4;
    public const FUNK = 5;
    public const GRUNGE = 6;
    public const HIP_HOP = 7;
    public const JAZZ = 8;
    public const METAL = 9;
    public const POP = 13;
    public const ROCK = 17;
    public const POLKA = 75;

    protected string $titre;
    protected int $genre = self::POP;
    protected int $duree = 0;
    protected string $fichierAudio;
    protected ?int $id = null;

    public function __construct(string $titre, string $chemin) {
        $this->titre = $titre;
        $this->fichierAudio = $chemin;
    }

    public function __toString(): string {
        return json_encode(get_object_vars($this));
    }

    public function __get(string $attrname): mixed {
        if (property_exists($this, $attrname)) {
            return $this->$attrname;
        }
        throw new InvalidPropertyNameException("Propriété inconnue : " . $attrname);
    }

    public function setGenre(int $genre): void {
        $this->genre = $genre;
    }

    public function setDuree(int $duree): void {
        if ($duree <= 0) {
            throw new InvalidPropertyValueException("Durée invalide : " . $duree . " (doit être > 0)");
        }
        $this->duree = $duree;
    }

    public static function getGenreAsString(int $genre): string {
        return match ($genre) {
            self::BLUES => "Blues",
            self::CLASSIC_ROCK => "Classic Rock",
            self::COUNTRY => "Country",
            self::DANCE => "Dance",
            self::DISCO => "Disco",
            self::FUNK => "Funk",
            self::GRUNGE => "Grunge",
            self::HIP_HOP => "Hip-Hop",
            self::JAZZ => "Jazz",
            self::METAL => "Metal",
            self::POP => "Pop",
            self::ROCK => "Rock",
            self::POLKA => "Polka",
            default => "Genre inconnu"
        };
    }
    
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
}