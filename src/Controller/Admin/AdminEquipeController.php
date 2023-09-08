<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminEquipeController extends AbstractController
{
    public function lister(EquipeRepository $EquipeRepository): Response
    {
        $equipes = $equipeRepository->findBy(
            [
                'coach' => $this->getUser()
            ]);

        return $this->render('admin/admin_equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }
    #[Route('/admin/admin/equipe', name: 'admin_equipe')]
    public function index(): Response
    {
        // Récupérez les équipes depuis la base de données
        $equipes = $this->getDoctrine()->getRepository(Equipe::class)->findAll();

        return $this->render('admin/admin_equipe/equipe.html.twig', [
            'controller_name' => 'AdminEquipeController',
            'equipes' => $equipes, // Passez les équipes au template
        ]);
    }
}
