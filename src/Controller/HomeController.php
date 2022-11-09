<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\Persistence\ManagerRegistry;
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
    #[Route('/news', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('home/news.html.twig', [
            'nbNews' => 3,
        ]);
    }
    #[Route('/product', name: 'app_product')]
    public function product(ManagerRegistry $doctrine): Response
    {
        $product = new Serie();
        $product->setTitre('Kono Subarashii Sekai ni Shukufuku o!(この素晴らしい世界に祝福を!)');
        $product->setResume("Adapté du roman Kono Subarashii Sekai ni Shukufuku wo! de Mishima Kurone et Akatsuki Natsume.

        La vie de Satou Kazuma, un hikikomori aimant les jeux, se termine bien trop tôt, dû à un accident de la route... Alors que ce dernier est décédé, une déesse nommée Aqua apparaît devant lui et lui propose de se réincarner dans l'au delà, prenant l'aspect d'un monde fantastique de jeu vidéo.
        
        Après s'être bien adapté à ce monde et vivant avec une petite équipe dont fait partie la déesse Aqua, une magicienne du nom de Megumin et une paladin masochiste, Kazuma est chargé d'une mission : vaincre le roi-démon. Cependant, en raison de l'incapacité de son groupe à réussir des quêtes, ce dernier va très vite renoncer à cette idée et tenter de profiter de ce monde si parfait à ses yeux.
        Malheureusement pour lui, leurs chemins vont très vite croiser ceux des généraux du roi démon, et c'est ainsi que les galères vont commencer.");
        $product->setDuree(new \DateTime('08:00:00'));
        $product->setPremiereDiffusion(new \DateTime('2016-01-13'));
        $product->setImage('https://i0.wp.com/cultureweeb.com/wp-content/uploads/2021/06/KonosubaBox.jpg?fit=547%2C800&ssl=1');
        $entityManager = $doctrine->getManager();
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->render('home/product.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('product/{id}', name: 'app_oneProduct')]
    public function  show($id, ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        $product = $repository->findOneBy(['name' => 'Keyboard']);
        $product = $repository->findOneBy(['name' => 'Keyboard','price' => 1999,]);
    }


}
