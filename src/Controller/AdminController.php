<?php

namespace App\Controller;
use App\Entity\Serie;
use App\Form\SerieType;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/series', name: '_addSeries')]
    public function addSerie(Request $req,PersistenceManagerRegistry $doctrine): Response
    {
        $serie= new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($serie);
            $entityManager->flush();
            return $this->redirectToRoute('app_serie');
        }
        return $this->render('admin/addSerie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/series/{id}', name: '_editSeries')]
    public function editSerie(Request $req,PersistenceManagerRegistry $doctrine,$id): Response
    {
        $serie= $doctrine->getRepository(Serie::class)->find($id);
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($serie);
            $entityManager->flush();
            return $this->redirectToRoute('app_serie');
        }
        return $this->render('admin/editSeries.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
}
