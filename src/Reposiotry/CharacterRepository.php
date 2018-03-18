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

    public function getCharactersList() : array
    {
        $lsitOfCharacters = array();
        while( false !== $characterFile = readdir($this->direcotryHandler)) {
            if(!in_array( $characterFile,['.', '..'] )) {
                $characterName = str_replace('.json', '', $characterFile);
                $lsitOfCharacters[] = $characterName;
            }
        }
        return $lsitOfCharacters;
    }


    public function getAllCharacters()
    {

    }


    public function getCharacterByName( string $name) : Character
    {
        $characterFile = self::ROOT_DATA_DIR.'/'.$name.'.json';
        $characterRawData = json_decode(file_get_contents($characterFile));
        
        return Character::createFromJson($characterRawData);
    }
}
