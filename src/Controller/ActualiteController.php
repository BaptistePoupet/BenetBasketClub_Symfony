<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use DateTime;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actualite;

#[Route('/actualite', name: 'app_actualite')]

class ActualiteController extends AbstractController
{
    #[Route('/liste', name: '_liste')]
    public function index(ActualiteRepository $actualiteRepository): Response
    {
        return $this->render('actualite/index.html.twig', [
            'actualites' => $actualiteRepository->findAll(),
        ]);
    }
    #[Route('/{id}', name: '_voir', requirements: ['id' => '\d+'])]
    public function voir(Actualite $actualite): Response
    {
        return $this->render('actualite/voir.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    #[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        return $this->render('actualite/detail.html.twig', [
            
            'id' => $id,
        ]);
        
    }
    #Cree une route /admin/actualite/ajouter#
    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('actualite/ajouter.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }
}