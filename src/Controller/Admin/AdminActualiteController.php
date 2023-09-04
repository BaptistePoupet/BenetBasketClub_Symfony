<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminActualiteController extends AbstractController
{
    #[Route('/admin/actualite', name: 'app_admin_actualite')]
    public function index(): Response
    {
        return $this->render('admin/admin_actualite/index.html.twig', [
            'controller_name' => 'AdminActualiteController',
        ]);
    }
    
    #[Route('/ajouter', name: 'admin_home')]
    public function ajouter(): Response
    {
        return $this->render('admin/actu.html.twig', [
            'controller_name' => 'Benet Basket Club',
        ]);
    }
    
    #[Route('/admin/actualite', name: 'admin_actualite_lister')]
    public function lister(ActualiteRepository $actualiteRepository): Response
    {
        $actualites = $actualiteRepository->findAll();
        
        return $this->render('admin/admin_actualite/index.html.twig', [
            'actualites' => $actualites
        ]);
    }
    
    #[Route('/admin/actualite/ajouter', name: 'admin_actalite_ajouter')]
    #[Route('/admin//modifier/{id}', name: 'admin_actualite_mdofier')]
    
    public function editer(Request $request, 
                            EntityManagerInterface $entityManagerInterface,  
                            actualiteRepository $actualiteRepository,
                            int $id = null): Response
    {
        if ($id == null){
            $actualite = new actualite();
        }else{
            $actualite = $actualiteRepository->find($id);
        }
        
        $actualite = new actualite();
        $form = $this->createForm(actualiteType::class, $actualite);
        $form->handleRequest($request);
        // si le form est soumis et valide
        if($form->isSubmitted() && $form->isValid()){
           
            // traitement des données
            $entityManagerInterface->persist($actualite);
            $entityManagerInterface->flush();
            
            //messages flash
            $this->addFlash('success', 'L actualite a bien été enregistré');

            return $this->redirectToRoute('admin_actualite_lister');
        
        }

        return $this->render('admin/admin_actualite/editer_actualite.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/admin/actualite/supprimer/{id}', name: 'admin_actualite_supprimer')]
    public function supprimer(EntityManagerInterface $entityManagerInterface,
                                actualiteRepository $actualiteRepository,
                                int $id): Response
    {
        $actualite = $actualiteRepository->find($id);
        $entityManagerInterface->remove($actualite);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin_actualite_lister');
    }
}
