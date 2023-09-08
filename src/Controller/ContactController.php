<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    #[Route('/contacter/envoyer_formulaire', name: 'contacter_envoyer_formulaire', methods: ['POST'])]
    public function envoyerFormulaire(Request $request, MailerInterface $mailer): Response
    {
        // Récupérer les données du formulaire
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $mail = $request->request->get('mail');
        $description = $request->request->get('description');

        // Créer le contenu de l'e-mail
        $message = "Nom: $nom\nPrénom: $prenom\nAdresse e-mail: $mail\nDescription: $description";

        // Créer l'e-mail
        $email = (new Email())
            ->from('votre_adresse_email@example.com')
            ->to('dirigieants.benetbasketclub@gmail.com')
            ->subject('Nouveau formulaire soumis')
            ->text($message);

        // Envoyer l'e-mail
        $mailer->send($email);

        // Rediriger ou afficher un message de confirmation
        // ...

        return $this->redirectToRoute('page_de_confirmation');
    }
}
