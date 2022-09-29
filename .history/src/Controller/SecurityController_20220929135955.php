<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use App\Repository\InscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
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

    #[Route('/user/{id}', methods:['POST'])]

    public function delete( $id, UserRepository $repo, ){

        $user = $repo->find($id);
        $repo->remove($user, true);
        $session = new Session();
        $session->invalidate();
        
        return $this->redirectToRoute('login');
        
    }


     #[Route(path: '/session', name: 'session')]
    public function examens(ExamensRepository $repo, CompetencesRepository $repo2): Response
    {           


        $examens = $repo->findAll();
        $competences = $repo2->findAll();
        $user = $this->getUser();
        $userId = count($user->getIdInscriptions()); // nbr d'inscription | utilisateur


       
        return $this->render('session/session.html.twig',['examens'=>$examens,'competences'=>$competences, 'user_id' => $userId]);
    }


   #[Route('session/{id}', name: 'show', methods:'POST')]
   
public function show($id, ExamensRepository $repo, InscriptionRepository $repo2) {
    $user = $this->getUser();

    // Count nbr registration of current User //
    $userId = count($user->getIdInscriptions());
    if($userId < 3) {
        $inscription = new Inscription();
        $examens = $repo->find($id);
        $inscription->setUser($user)
                    ->setExamens($examens);
        $repo2->add($inscription, true);
    }
    else {
        // die();
        $this->addFlash('error', 'Calme toi frérot t'r)
    }
        return $this->redirectToRoute('session');

}
   

    }