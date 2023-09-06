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

    #[Route('/admin/actualite/ajouter', name: 'admin_actualite_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('admin/actu.html.twig', [
            'controller_name' => 'Benet Basket Club',
        ]);
    }

    #[Route('/admin/actualite/lister', name: 'admin_actualite_lister')]
    public function lister(ActualiteRepository $actualiteRepository): Response
    {
        $actualites = $actualiteRepository->findAll();

        return $this->render('admin/admin_actualite/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    #[Route('/admin/actualite/editer/{id}', name: 'admin_actualite_editer')]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        ActualiteRepository $actualiteRepository,
        int $id = null
    ): Response {
        if ($id === null) {
            $actualite = new Actualite();
        } else {
            $actualite = $actualiteRepository->find($id);
        }

        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vous devez gérer l'enregistrement de l'actualité ici
            // $entityManager->persist($actualite);
            // $entityManager->flush();

            $this->addFlash('success', 'L\'actualité a bien été enregistrée');

            return $this->redirectToRoute('admin_actualite_lister');
        }

        return $this->render('admin/admin_actualite/editer_actualite.html.twig', [
            'form' => $form->createView(),
            'actualite' => $actualite,
        ]);
    }

    #[Route('/admin/actualite/supprimer/{id}', name: 'admin_actualite_supprimer')]
    public function supprimer(
        EntityManagerInterface $entityManager,
        ActualiteRepository $actualiteRepository,
        int $id
    ): Response {
        $actualite = $actualiteRepository->find($id);

        if (!$actualite) {
            throw $this->createNotFoundException('L\'actualité n\'existe pas.');
        }

        $entityManager->remove($actualite);
        $entityManager->flush();

        $this->addFlash('success', 'L\'actualité a bien été supprimée');

        return $this->redirectToRoute('admin_actualite_lister');
    }
}
