<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'editUser', methods:[ 'GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('login');
        }

        if(!($this->getUser() === $user)){
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();
    
                $this->addFlash(
                    'success',
                    'Les informations ont bien été mises à jour'
                );
    
                return $this->redirectToRoute('home');
            }else{
                $this->addFlash(
                    'warning',
                    'Mot de passe incorrect'
                );
            }

            
        }


        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/utilisateur/edition/mot-de-passe/{id}", name:"editMdp", methods:[ 'GET', 'POST'])]
    public function editPassword(User $user, Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager): Response {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])){
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le mot de passe a bien été modifié'
                );
                return $this->redirectToRoute('editUser',['id' => $user->getId()]);
            }else{
                $this->addFlash(
                    'warning',
                    'Mot de passe incorrect'
                );
            }
        }

        return $this->render('pages/user/editPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
