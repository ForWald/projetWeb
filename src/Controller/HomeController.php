<?php

namespace App\Controller;

use App\Repository\ExerciceRepository;
use App\Repository\ProgrammeRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProgrammeRepository $programmeRepository, SeanceRepository $seanceRepository): Response
    {
        return $this->render('pages/home.html.twig', [
            'programmes' => $programmeRepository->findAll(),
            'seances' => $seanceRepository->findAll()
        ]);
    }
}
