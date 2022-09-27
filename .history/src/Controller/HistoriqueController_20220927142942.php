<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Repository\ExamensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique/{id}', name: 'historique')]
    public function index($id, ExamensRepository $repo): Response
    {
        $user = $this->getUser();
        $examens = $repo->find($id);
        dd($examens);
        

        return $this->render('historique/session.html.twig',['examens'=>$examens]);
    }
}
