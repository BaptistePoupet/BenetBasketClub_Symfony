<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipe;
use App\Repository\EquipeRepository;   
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EquipeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'app_equipe')]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe_voir', requirements: ['id' => '\d+'])]
    public function voir(Equipe $equipe): Response
    {
        return $this->render('equipe/voir.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        return $this->render('equipe/detail.html.twig', [
            'id' => $id,
        ]);
    }
}
