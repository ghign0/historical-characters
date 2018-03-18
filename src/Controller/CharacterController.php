<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use App\Reposiotry\CharacterRepository;

class CharacterController extends SymfonyController
{
    private $characterRepository;

    public function __construct()
    {
        $this->characterRepository = new CharacterRepository();
    }


    public function list()
    {
        $this->characterRepository->getCharactersList();
        return $this->render('@template/characters/ist.html.twig', [
            'chars' => $chars
        ]);
    }

    public function detail($name)
    {
        if ( !in_array($name,$this->characterRepository->getCharactersList())) {
            return $this->redirectToRoute('404');
        }

        $character = $this->characterRepository->getCharacterByName($name);

        return $this->render('@template/characters/detail.html.twig', [
            'character' => $character
        ]);
    }
}
