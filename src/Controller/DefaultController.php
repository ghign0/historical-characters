<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class DefaultController extends SymfonyController
{

    public function homepage()
    {

        return $this->render('mainTemplate/index.html.twig', [
            'name' => 'Marco'
        ]);
    }
}