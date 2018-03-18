<?php
/**
 * Created by PhpStorm.
 * User: ghign0
 * Date: 18/03/18
 * Time: 12.50
 */

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


}