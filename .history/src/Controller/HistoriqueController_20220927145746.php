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
    #[Route('/historique/{id}', name: 'historique', methods:'GET')]
    public function index($id, InscriptionRepository $repo): Response
    {
        $user = $this->getUser();
     
        
        // dd($RegisteredExam, $id);
        

        return $this->render('historique/index.html.twig',['registeredExam'=>$RegisteredExam]);
    }
}
