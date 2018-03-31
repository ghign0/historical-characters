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

    /** @var  string */
    private $slug;

    /** @var array */
    private $categories;

    /** @var bool  */
    private $hompage;


    public function __construct(
        string $name,
        string $surname,
        DateTime $dateOfBirth,
        string $cityOfBirth,
        DateTime $dateOfDeath,
        string $cityOfDeath,
        string $bio,
        string $summary,
        string $slug,
        array $categories,
        bool $homepage = false
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
        $this->slug = $slug;
        $this->categories = $categories;
        $this->hompage = $homepage;
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
            $json->summary,
            $json->config->slug,
            $json->options->categories,
            $json->config->homepage
        );
    }

    public function getCentury()
    {
        $yearOfBirth = $this->dateOfBirth->format('YYYY');
        $century = (int)substr($yearOfBirth,0,-2)+1;
        return $century;
    }

    public function getYearOfBirth()
    {
        return $this->dateOfBirth->format('YYYY');
    }


    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function isForHompage() :bool
    {
        if($this->hompage) {
            return true;
        }
        return false;
    }
}
