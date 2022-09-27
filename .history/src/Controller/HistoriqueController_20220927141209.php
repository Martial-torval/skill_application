<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique', name: 'h')]
    public function index(): Response
    {
        return $this->render('historique/index.html.twig', [
            'controller_name' => 'HistoriqueController',
        ]);
    }
}
