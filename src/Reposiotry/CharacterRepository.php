<?php

namespace App\Reposiotry;

use App\Event\SanitizeDataAfetrLoadEvent;
use App\Model\Entity\Character;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Service\Sanitizer;


class CharacterRepository
{
    const ROOT_DATA_DIR = __DIR__.'/../../data';

    private $direcotryHandler;

    private $dispatcher;

    /**
     * CharacterRepository constructor.
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        $this->direcotryHandler = opendir(self::ROOT_DATA_DIR);
        $this->dispatcher = $dispatcher;
    }

    /**
     * Resittuiscce la lista dei nomi
     *
     * @return array
     */
    public function getCharactersNameList() : array
    {
        $listOfCharacters = array();
        while( false !== $characterFile = readdir($this->direcotryHandler)) {
            if(!in_array( $characterFile,[ '.', '..', 'character.json.dist' ] )) {
                $characterSlug= str_replace('.json', '', $characterFile);
                $listOfCharacters[] = $characterSlug;
            }
        }
        return $listOfCharacters ;
    }


    public static function GetCharsList()
    {
        $directoryHandler = opendir(self::ROOT_DATA_DIR);
        $lsitOfCharacters = array();
        while( false !== $characterFile = readdir($directoryHandler)) {
            if(!in_array( $characterFile,[ '.', '..', 'character.json.dist' ] )) {
                $characterSlug= str_replace('.json', '', $characterFile);
                $lsitOfCharacters[] = $characterSlug;
            }
        }
        return $lsitOfCharacters;
    }


    /**
     * Restituisce diversi tipi di liste di characters
     *
     * all                          - tutti
     * hompegae                     - tutti quelli che hanno isForHompage() = true
     * random [ 'random-number' ]   - un numero causale di Characters
     * anniversary                  - i Characters nati nello stesso giorno e mese di oggi
     * year ['year']                - tutti quelli di un determinato anno
     * century ['century']          - tutti quelli di un determinato secolo
     *
     * @param string $typeOfList
     * @param array $parameters
     * @return array
     */
    public function getCharacters( string $typeOfList, array $parameters) : array
    {
        $characters = array();
        $listOfCharacters = $this->getCharactersNameList();
        switch ($typeOfList) {
            case 'all':
                $characters = $this->getAllCharacters($listOfCharacters);
                break;

            case 'homepage' :
                $characters = $this->getCharactersForHomepgae($listOfCharacters);
                break;
            case 'anniversary' :
                $characters = $this->getCharactersOfTheDay($listOfCharacters);
                break;

            case 'random':
                $characters = $this->getRandomCharacters( $listOfCharacters, $parameters['random-number'] );
                break;

            case 'alphabetic':
                $characters = $this->getCharactersByAlphabet($listOfCharacters, $parameters['letter']);
                break;
            case 'category' :
                $characters = $this->getCharactersByCategory($listOfCharacters, $parameters['category']);
                break;

            default:
                $characters = $this->getAllCharacters($listOfCharacters);
        }

        return $characters;
    }


    /**
     * Restituisce il character dal nome
     *
     * @param string $slug
     * @return Character
     */
    public function getCharacterByFilename( string $slug) : Character
    {
        $characterFile = self::ROOT_DATA_DIR.'/'.$slug.'.json';
        $characterRawData = json_decode(file_get_contents($characterFile));

        $character = Character::createFromJson($characterRawData);
        $character->setSummary( Sanitizer::sanitizeText($character->getSummary()) );

        /**  Pulisce il testo   */
        # $this->dispatcher->dispatch(SanitizeDataAfetrLoadEvent::NAME , new SanitizeDataAfetrLoadEvent($character));

        return $character;
    }

    /**
     * Restituisce tutti i Characters
     *
     * @param $listOfCharacters
     * @return array
     */
    private function getAllCharacters(array $listOfCharacters)  : ?array
    {
        foreach( $listOfCharacters as $characterFilename) {
            $characters[] = $this->getCharacterByFilename($characterFilename);
            }
        return $characters;
    }

    /**
     * Restituisce lista di Character per la homepage
     *
     * @return array
     */
    private function getCharactersForHomepgae(array $listOfCharacters) : array
    {

        foreach( $listOfCharacters as $characterFilename) {
            $characters[] = $this->getCharacterByFilename($characterFilename);
        }

        return $characters;
    }

    private function getCharactersOfTheDay(array $listOfCharacters ): array
    {
        foreach( $listOfCharacters as $characterFilename) {
            $characters[] = $this->getCharacterByFilename($characterFilename);
        }
        return $characters;
    }

    private function getRandomCharacters( array $listOfCharacters , int $randomNumer ): array
    {
        shuffle( $listOfCharacters);
        $listOfCharacters = array_slice($listOfCharacters, 0, $randomNumer );

        foreach( $listOfCharacters as $characterFilename) {
            $characters[] = $this->getCharacterByFilename($characterFilename);
        }
        return $characters;

    }

    private function getCharactersByAlphabet( array $listOfCharacters, string $letter ) : array
    {
        foreach ( $listOfCharacters as $characterFilename) {
            if(substr($characterFilename,0,1) === $letter) {
                $characters[] = $this->getCharacterByFilename($characterFilename);
            }
            return $characters;
        }

    }

    private function getCharactersOfTheYear(array $listOfCharacters, $year) : array
    {
        foreach ( $listOfCharacters as $characterFilename) {
            $character = $this->getCharacterByFilename($characterFilename);
            if($character->getYearOfBirth() === $year) {
                $characters[] = $character ;
            }
        }

        return $characters;
    }

    private function getCharactersOfTheCentury(array $listOfCharacters, $century) : array
    {
        foreach ( $listOfCharacters as $characterFilename) {
            $character = $this->getCharacterByFilename($characterFilename);
            if($character->getCentury() === $century ) {
                $characters[] = $character ;
            }
        }
    }

}
