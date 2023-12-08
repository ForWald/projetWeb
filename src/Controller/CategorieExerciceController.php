<?php

namespace App\Controller;

use App\Entity\CategorieExercice;
use App\Form\CategorieExerciceType;
use App\Repository\CategorieExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/exercice')]
class CategorieExerciceController extends AbstractController
{
    #[Route('/', name: 'app_categorie_exercice_index', methods: ['GET'])]
    public function index(CategorieExerciceRepository $categorieExerciceRepository): Response
    {
        return $this->render('categorie_exercice/index.html.twig', [
            'categorie_exercices' => $categorieExerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieExercice = new CategorieExercice();
        $form = $this->createForm(CategorieExerciceType::class, $categorieExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieExercice);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_exercice/new.html.twig', [
            'categorie_exercice' => $categorieExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_exercice_show', methods: ['GET'])]
    public function show(CategorieExercice $categorieExercice): Response
    {
        return $this->render('categorie_exercice/show.html.twig', [
            'categorie_exercice' => $categorieExercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_exercice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieExercice $categorieExercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieExerciceType::class, $categorieExercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_exercice/edit.html.twig', [
            'categorie_exercice' => $categorieExercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieExercice $categorieExercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieExercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieExercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}