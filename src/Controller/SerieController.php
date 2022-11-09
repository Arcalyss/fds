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
    /*public function showSerie(PdoFouDeSerie $pdoFouDeSerie): Response
    {
        $serie = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countLesSeries();
        return $this->render('serie_controller/serie.html.twig', [
            'LesSeries' => $serie,
            'nbSeries' => $nbSeries,
        ]);
    }
    */

    #[Route('/serie/{id}', name: 'app_serie_id')]
    public function showSerieId(ManagerRegistry $doctrine, int $id): Response
    {
        $repository=$doctrine->getRepository(Serie::class);
        $serie=$repository->find($id);
        dump($serie);
        return $this->render('serie_controller/detailSerie.html.twig',[
            'serie'=>$serie]);
    }
}