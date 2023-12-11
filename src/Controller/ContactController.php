<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(
        Request                $request,
        EntityManagerInterface $manager
    ): Response {
        $contact = new Contact();

        if ($this->getUser()) {
            $contact
                ->setNom($this->getUser()->getNom())
                ->setPrenom($this->getUser()->getPrenom())
                ->setEmail($this->getUser()->getEmail());
        }
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre demande d\'assistance à été envoyée avec succès.'
            );
            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
