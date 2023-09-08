<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeClubController extends AbstractController
{
    #[Route('/le/club', name: 'app_le_club')]
    public function index(): Response
    {
        return $this->render('le_club/index.html.twig', [
            'controller_name' => 'LeClubController',
        ]);
    }
}
