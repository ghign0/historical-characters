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
        $chars = $this->characterRepository->getCharactersList();
        return $this->render('@template/characters/ist.html.twig', [
            'chars' => $chars
        ]);
    }

    public function detail($slug)
    {
        if ( !in_array($slug,$this->characterRepository->getCharactersList())) {
            return $this->redirectToRoute('404');
        }

        $character = $this->characterRepository->getCharacterByFilename($slug);

        return $this->render('@template/characters/detail.html.twig', [
            'character' => $character
        ]);
    }
}
