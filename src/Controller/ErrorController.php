<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class ErrorController extends SymfonyController
{
    public function error403()
    {
        return $this->render('@template/errors/403.html.twig', []);
    }

    public function error404()
    {
        return $this->render('@template/errors/404.html.twig', []);
    }

    public function listNotfoundError ()
    {
        return $this->render('@template/errors/list-not-found.html.twig', []);
    }

}