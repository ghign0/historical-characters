<?php

namespace App\Controller;

use App\Event\SanitizeDataAfetrLoadEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use App\Reposiotry\CharacterRepository;
use App\Model\Entity\Character;
use Symfony\Component\EventDispatcher\EventDispatcher;

class DefaultController extends SymfonyController
{
    /**
     * carica il CharacterRepository
     *
     * @return CharacterRepository
     */
    private function getRepository() : CharacterRepository
    {
        $dispatcher = $this->get('event_dispatcher');
        return  new CharacterRepository($dispatcher);
    }


    public function homepage()
    {
        $characterRepository = $this->getRepository();

        $characters = $characterRepository->getCharacters('homepage',[]);

        return $this->render('@template/index.html.twig', [
            'characters' => $characters
        ]);
    }
}
