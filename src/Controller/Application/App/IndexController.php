<?php

namespace App\Controller\Application\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            'user_authenticated' => $this->getUser() ? true : false
        ]);
    }
}