<?php

namespace App\EventListener;

use App\Event\SanitizeDataAfetrLoadEvent;


class SanitizeDataAfterLoadEventListener
{

    public function onCharacterLoaded(SanitizeDataAfetrLoadEvent $event)
    {
        $character = $event->getCharacter();

        $summary = $character->getSummary();
        $summary  = str_replace('&Egrave;', 'è', $summary);
        $character->setSummary($summary);
    }

}