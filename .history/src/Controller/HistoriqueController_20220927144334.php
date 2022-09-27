<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Repository\ExamensRepository;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique/{id}', name: 'historique')]
    public function index($id, ExamensRepository $repo, InscriptionRepository $repo2): Response
    {
        $user = $this->getUser();
        $examens = $repo->findAll();
        $inscriptio
        dd($examens);
        

        return $this->render('historique/index.html.twig',['examens'=>$examens]);
    }
}
