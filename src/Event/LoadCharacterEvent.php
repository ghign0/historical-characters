<?php

namespace App\Event;

use App\Model\Entity\Character;
use Symfony\Component\EventDispatcher\Event;


/**
 * Class LoadCharacterEvent
 *  the character.loaded is dispatched each time a json has been read
 */
class LoadCharacterEvent extends Event
{

    const NAME = 'character.loaded';

    protected $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @return Character
     */
    public function getCharacter(): Character
    {
        return $this->character;
    }
}