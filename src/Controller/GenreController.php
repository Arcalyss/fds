<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use Container0KnHgkx\getSerieControllerService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/testgenre', name: 'app_genre')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $genre = new Genre();
        $genre->setLibelle('Comédie');
        $repository=$doctrine->getRepository(Serie::class);
        $serie=$repository->find(37);
        $serie -> addGenre($genre);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($genre);
        $entityManager->flush();

        return $this->render('genre/genre.html.twig', [
            'serie' => $serie,
        ]);
    }
}
