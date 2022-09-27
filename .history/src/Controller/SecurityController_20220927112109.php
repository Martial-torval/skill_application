<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('user');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/security/user', name: 'user')]
    public function user(): Response
    {
        $user = $this->getUser();
        
        return $this->render('security/user.html.twig',['user'=>$user]);
    }


     #[Route(path: '/session', name: 'session')]
    public function examens($id, ExamensRepository $repo, CompetencesRepository $repo2, InscriptionRepository $repo3): Response
    {           
        


    // $nbrRegistereds = count($repo3->findBy(['id' => $id]));
    $examens = $repo3->findOneBy('examens_id'=> $id);
    
    //  $user = $this->getUser();
    // $currentUser = $user->getIdInscriptions();
     
    
    dd($examens);
    // $registerToExam = $userEntity->getIdInscriptions();
    // dd($registerToExam);

        $examens = $repo->findAll();

        $competences = $repo2->findAll();
       
        return $this->render('session/session.html.twig',['examens'=>$examens,'competences'=>$competences, 'nbrRegistereds'=>$nbrRegistereds]);
    }


   #[Route('session/{id}', name: 'show', methods:'POST')]
   
public function show($id, ExamensRepository $repo, InscriptionRepository $repo2) {
    $inscription = new Inscription();
    $user = $this->getUser();
    $examens = $repo->find($id);
    $inscription->setUser($user)
                ->setExamens($examens);
    dd($inscription);
    $repo2->add($inscription, true);
return $this->redirectToRoute('session');
}
   

    }