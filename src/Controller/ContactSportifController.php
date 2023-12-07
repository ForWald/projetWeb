<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\ContactSportif;
use App\Form\ContactSportifType;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactSportifController extends AbstractController
{
    #[Route('/contact-sportif', name: 'contact-sportif')]
    public function index(
        Request                $request,
        EntityManagerInterface $manager
    ): Response
    {
        $contactsportif = new ContactSportif();

        if($this->getUser()) {
            $contactsportif
                ->setNom($this->getUser()->getNom())
                ->setPrenom($this->getUser()->getPrenom())
                ->setEmail($this->getUser()->getEmail());
        }
        $form = $this->createForm(ContactSportifType::class, $contactsportif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactsportif = $form->getData();
            $manager->persist($contactsportif);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre demande de contact sportif à été envoyée avec succès.
                 Un coach vous répondra dès que possible"
            );
            return $this->redirectToRoute('contact-sportif');

        }

        return $this->render('pages/contact/contact_sportif.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
