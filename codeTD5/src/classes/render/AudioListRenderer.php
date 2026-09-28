<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer implements Renderer {
    private AudioList $audioList;

    public function __construct(AudioList $audioList) {
        $this->audioList = $audioList;
    }

    public function render(int $selector = 0): string {
        $html = "<div class='audio-list'>\n";
        $html .= "  <h2>Liste : {$this->audioList->nom}</h2>\n";
        $html .= "  <div class='tracks'>\n";

        // On utilise la boucle directement sur $audioList (Iterator)
        // et la factory pour obtenir le bon renderer
        foreach ($this->audioList as $piste) {
            $renderer = RendererFactory::getRenderer($piste);
            $html .= $renderer->render(Renderer::COMPACT);
        }

        $html .= "  </div>\n";
        $html .= "  <p>Total : {$this->audioList->nbPistes} pistes | Durée totale : {$this->audioList->dureeTotale} s</p>\n";
        $html .= "</div>\n";

        return $html;
    }
}