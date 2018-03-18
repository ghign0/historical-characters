<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class ErrorController extends SymfonyController
{
    public function error403()
    {
        return $this->render('mainTemplate/errors/403.html.twig', []);
    }

    public function error404()
    {
        return $this->render('mainTemplate/errors/404.html.twig', []);
    }

}