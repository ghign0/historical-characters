<?php
/**
 * Created by PhpStorm.
 * User: mghinassi
 * Date: 07/05/18
 * Time: 15.43
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use App\Reposiotry\CategoryRepository;

class CategoryController extends SymfonyController
{

    private function getRepository()
    {
        return new CategoryRepository();
    }

    public function list()
    {
        $categoryRepository = $this->getRepository();
        $listOfAllaCategories = $categoryRepository->getAllCategories();
    }
}