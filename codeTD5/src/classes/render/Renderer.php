<?php
namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;

interface Renderer {
    public const COMPACT = 1;
    public const LONG = 2;

    public function render(int $selector): string;
}