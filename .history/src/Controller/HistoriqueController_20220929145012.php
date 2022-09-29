<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique/{id}', name: 'historique', methods:'GET')]
    public function index(ExamensRepository $repo): Response
    {
        $user = $this->getUser();
        $inscriptions = $user->getIdInscriptions();

        $
        // dd($inscriptions);
        
        
        
        // $exam = $repo->findAll();
        
        

        return $this->render('historique/index.html.twig',['exams'=>$inscriptions]);
    }
}
