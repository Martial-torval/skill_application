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
    #[Route('/historique/{id}', name: 'historique', methods:'G')]
    public function index($id, ExamensRepository $repo): Response
    {
        $user = $this->getUser();
        $a = $user->getUserIdentifier();
        // $inscriptionCurrentUser = $repo2->find($id);
        dd($a);
        

        return $this->render('historique/index.html.twig',['examens'=>$examens]);
    }
}
