<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEquipeController extends AbstractController
{
    #[Route('/admin/admin/equipe', name: 'admin_equipe')]
    public function index(): Response
    {
        return $this->render('admin/admin_equipe/index.html.twig', [
            'controller_name' => 'AdminEquipeController',
        ]);
    }
}
