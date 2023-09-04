<?php

namespace App\Controller;

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $actualite = new stdClass();
        //$actualite->description = "Ce actualite est incroyable";

        return $this->render('main/index.html.twig', [
            'controller_name' => 'Benet Basket Club',
            
        ]);
    }
}
