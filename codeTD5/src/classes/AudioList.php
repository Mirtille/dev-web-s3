<?php
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\exception\InvalidPropertyNameException;

require_once 'AudioTrack.php';
require_once 'InvalidPropertyNameException.php';

class AudioList {
    protected string $nom;
    protected int $nbPistes = 0;
    protected int $dureeTotale = 0;
    protected array $pistes = [];

    public function __construct(string $nom, array $pistes = []) {
        $this->nom = $nom;
        $this->pistes = $pistes;
        $this->nbPistes = count($pistes);

        foreach ($pistes as $piste) {
            $this->dureeTotale += $piste->duree;
        }
    }

    public function __get(string $attrname): mixed {
        if (property_exists($this, $attrname)) {
            return $this->$attrname;
        }
        throw new InvalidPropertyNameException("Propriété inconnue : " . $attrname);
    }
}