<?php

namespace App\Controller;

use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ExamensRepository $repo,CompetencesRepository $repo2): Response
    {
        $examens = $repo->findAll();
        $competences = $repo2->findAll();
        return $this->render('home/index.html.twig',['examens'=>$examens,'competences']);
    }

  

    #[Route('/session', name: 'session')]
    public function session(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
