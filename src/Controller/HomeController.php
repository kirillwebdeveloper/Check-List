<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return string
     *
     * @Route(
     *     "",
     *     name="home",
     *     methods={"GET"}
     * )
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}