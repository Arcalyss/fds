<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'series' => 'ça matte Netflix ou quoi ?',
        ]);
    }
    #[Route('/news.html.twig', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('home/news.html.twig', [
            'nbNews' => 3,
        ]);
    }

}
