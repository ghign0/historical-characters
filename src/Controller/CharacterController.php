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
        return $this->render('mainTemplate/char-list.html.twig', [
            'chars' => $chars
        ]);
    }

    public function detail($name)
    {
        if ( !in_array($name, ['pippo','pluto','papaerino'])) {
            return $this->redirectToRoute('404');
        }

        return $this->render('mainTemplate/char-detail.html.twig', [
            'name' => $name
        ]);
    }
}
