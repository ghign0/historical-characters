<?php

namespace App\Model\Entity;

use \DateTime;

class Character
{

    /** @var string  */
    private $name;

    /** @var string  */
    private $surname;

    /** @var DateTime  */
    private $dateOfBirth;

    /** @var string  */
    private $cityOfBirth;

    /** @var DateTime  */
    private $dateOfDeath;

    /** @var string  */
    private $cityOfDeath;

    /** @var string  */
    private $bio;

    /** @var string  */
    private $summary;


    public function __construct(
        string $name,
        string $surname,
        DateTime $dateOfBirth,
        string $cityOfBirth,
        DateTime $dateOfDeath,
        string $cityOfDeath,
        string $bio,
        string $summary
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->dateOfBirth = $dateOfBirth;
        $this->cityOfBirth = $cityOfBirth;
        $this->dateOfDeath = $dateOfDeath;
        $this->cityOfDeath = $cityOfDeath;
        $this->bio = $bio;
        $this->summary = $summary;
    }

    public static function createFromJson ($json)
    {
        $birthDate = new DateTime($json->birth->date);
        $deathDate = new DateTime($json->death->date);
        return new Character(
            $json->name,
            $json->surname,
            $birthDate,
            $json->birth->city,
            $deathDate,
            $json->death->city,
            $json->bio,
            $json->summary
        );
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }
}
