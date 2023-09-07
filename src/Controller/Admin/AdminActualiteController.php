<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminActualiteController extends AbstractController
{
    #[Route('/admin/actualite', name: 'admin_actualite_lister')]
    public function lister(ActualiteRepository $actualiteRepository): Response
    {
        $actualites = $actualiteRepository->findAll();

        return $this->render('admin/admin_actualite/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    #[Route('/admin/actualite/ajouter', name: 'admin_actualite_ajouter')]
    #[Route('/admin/actualite/modifier/{id}', name: 'admin_actualite_modifier')]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        ActualiteRepository $actualiteRepository,
        SluggerInterface $slugger,
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
            $photoFile = $form->get('photoPrincipal')->getData();
            
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('actualite_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer les erreurs de téléchargement ici
                }

                $actualite->setPhotoPrincipal($newFilename);
            }

            $entityManager->persist($actualite);
            $entityManager->flush();

            $this->addFlash('success', 'Le actualite a actualite été enregistré');

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

        if ($actualite) {
            $entityManager->remove($actualite);
            $entityManager->flush();

            $this->addFlash('success', 'Le actualite a actualite été supprimé');
        } else {
            $this->addFlash('error', 'Le actualite n\'existe pas');
        }

        return $this->redirectToRoute('admin_actualite_lister');
    }
}
