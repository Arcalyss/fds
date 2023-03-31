<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
use App\Entity\Serie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]

    public function showSerie(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Serie::class);

        #affiche toutes les series
        #$lesSeries=$repository->findAll();

        #affiche les series par ordre alphabetique
        $lesSeries=$repository->findBy([],['titre'=>'ASC']);

        #affiche les series par ordre alphabetique et limite a 2 (les 2 premieres)
        #$lesSeries=$repository->findBy([],['premiereDiffusion'=>'DESC'],2);

        dump($lesSeries);
        return $this->render('serie_controller/serie.html.twig',[
            'LesSeries'=>$lesSeries]);

    }

    #[Route('/serie/{id}', name: 'app_serie_id')]
    public function showSerieId(ManagerRegistry $doctrine, int $id): Response
    {
        $repository=$doctrine->getRepository(Serie::class);
        $serie=$repository->find($id);
        dump($serie);
        //recuperer la valeur des likes
        $likes=$serie->getLikes();
        if ($likes==null){
            $likes=0;
        }
        return $this->render('serie_controller/detailSerie.html.twig',[
            'serie'=>$serie,
            'likes'=>$likes]);
    }

    #[Route('/serie/{id}/like', name: 'app_serie_id_like')]
    public function getLikeOneSerie(ManagerRegistry $doctrine, int $id): Response
    {
        $repository=$doctrine->getRepository(Serie::class);
        //si l'id n'existe pas renvoyer une erreur 404
        try{
            $serie=$repository->find($id);
            if ($serie==null)
            throw $this->createNotFoundException("La serie n'existe pas");
        }catch (\Exception $e){
            return $this->json(['message'=>$e->getMessage()],404);

        }
        //recuperer la valeur des likes
        $likes=$serie->getLikes();
        if ($likes==null){
            $likes=0;
        }
        //incrementer les likes
        $likes++;
        //enregistrer les likes
        $serie->setLikes($likes);
        //enregistrer en base de données
        $em=$doctrine->getManager();
        $em->persist($serie);
        $em->flush();
        return $this->redirectToRoute('app_serie_id',['id'=>$id]);
    }
}