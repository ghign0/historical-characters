<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use App\Reposiotry\CharacterRepository;
use App\Model\Entity\Character;

class DefaultController extends SymfonyController
{
    private $characterRepository;

    public function __construct()
    {
        $this->characterRepository = new CharacterRepository();
    }

    public function homepage()
    {
        $characters = $this->characterRepository->getCharactersForHomepgae();

        return $this->render('@template/index.html.twig', [
            'characters' => $characters
        ]);
    }
}
