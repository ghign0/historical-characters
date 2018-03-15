<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class CharacterController extends SymfonyController
{
    public function list()
    {
        $chars = [
            'pippo',
            'pluto',
            'paperino'
        ];
        $this->render('mainTemplate/char-list.html.twig', [
            'chers' => $chars
        ]);
    }

    public function detail($name)
    {
        $this->render('mainTemplate/char-detail.html.twig', [
            'name' => $name
        ]);
    }
}