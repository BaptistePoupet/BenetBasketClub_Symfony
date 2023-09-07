<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use DateTime;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actualite;

#[Route('/bien', name: 'app_bien')]

class ActualiteController extends AbstractController
{
    #[Route('/liste', name: '_liste')]
    public function index(ActualiteRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'biens' => $bienRepository->findAll(),
        ]);
    }
    #[Route('/{id}', name: '_voir', requirements: ['id' => '\d+'])]
    public function voir(Actualite $bien): Response
    {
        return $this->render('bien/voir.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        return $this->render('bien/detail.html.twig', [
            
            'id' => $id,
        ]);
        
    }
    #Cree une route /admin/bien/ajouter#
    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('bien/ajouter.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }
}