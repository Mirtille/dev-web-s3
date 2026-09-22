<?php
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\exception\InvalidPropertyNameException;

require_once 'AudioList.php';
require_once 'AudioTrack.php';

class Playlist extends AudioList {

    public function addTrack(AudioTrack $piste): void {
        $this->pistes[] = $piste;
        $this->nbPistes++;
        $this->dureeTotale += $piste->duree;
    }

    public function removeTrack(int $index): void {
        if (isset($this->pistes[$index])) {
            $this->dureeTotale -= $this->pistes[$index]->duree;
            $this->nbPistes--;
            array_splice($this->pistes, $index, 1);
        }
    }

    public function addTrackList(array $pistes): void {
        foreach ($pistes as $piste) {
            if (!in_array($piste, $this->pistes, true)) {
                $this->addTrack($piste);
            }
        }
    }
}