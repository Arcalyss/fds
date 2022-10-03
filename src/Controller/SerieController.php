<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]

    public function showSerie(PdoFouDeSerie $pdoFouDeSerie): Response
    {
        $serie = $pdoFouDeSerie->getLesSeries();
        $nbSeries = $pdoFouDeSerie->countLesSeries();
        return $this->render('serie_controller/serie.html.twig', [
            'LesSeries' => $serie,
            'nbSeries' => $nbSeries,
        ]);
    }
}
