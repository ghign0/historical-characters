<?php


namespace App\Reposiotry;


class CharacterRepository
{
    const ROOT_DATA_DIR = __DIR__.'../data';

    public function __construct(){}


    public function getAllCharacters()
    {
        $handle = opendir(self::ROOT_DATA_DIR);
    }

}