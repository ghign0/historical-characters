<?php

namespace App\Reposiotry;

use App\Model\Entity\Character;

class CharacterRepository
{
    const ROOT_DATA_DIR = __DIR__.'/../../data';

    private $direcotryHandler;

    public function __construct()
    {
        $this->direcotryHandler = opendir(self::ROOT_DATA_DIR);
    }

    /**
     * @return array
     */
    public function getCharactersList() : array
    {
        $lsitOfCharacters = array();
        while( false !== $characterFile = readdir($this->direcotryHandler)) {
            if(!in_array( $characterFile,['.', '..'] )) {
                $characterSlug= str_replace('.json', '', $characterFile);
                $lsitOfCharacters[] = $characterSlug;
            }
        }
        return $lsitOfCharacters;
    }


    public function getAllCharacters()
    {

    }

    public function getCharacterByFilename( string $slug) : Character
    {
        $characterFile = self::ROOT_DATA_DIR.'/'.$slug.'.json';
        $characterRawData = json_decode(file_get_contents($characterFile));
        
        return Character::createFromJson($characterRawData);
    }


    public function getCharactersForHomepgae()
    {
        $characters = array();
        $lsitOfCharacters = $this->getCharactersList();

        foreach( $lsitOfCharacters as $characterFilename) {

            $characters[] = $this->getCharacterByFilename($characterFilename);

        }
        return $characters;
    }
}
