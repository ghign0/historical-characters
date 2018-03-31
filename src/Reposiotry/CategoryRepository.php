<?php
/**
 * Created by PhpStorm.
 * User: mghinassi
 * Date: 31/03/18
 * Time: 13.08
 */

namespace App\Reposiotry;


use App\Model\Entity\Character;

class CategoryRepository
{
    const ROOT_DATA_DIR = __DIR__.'/../../data';

    public static function getAllCategories() : array
    {
        foreach (CharacterRepository::GetCharsList() as $characterFilename) {

            $character = Character::createFromJson(json_decode(file_get_contents(self::ROOT_DATA_DIR.'/'.$characterFilename.'.json')));
            $categories[] = $character->getCategories();
        }
        $categoriesLlst = array_unique(call_user_func_array('array_merge', $categories));

        return $categoriesLlst;
    }
}