<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use App\Repository\InscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        
        return $this->render('security/user.html.twig',['user'=>$user]);
    }


     #[Route(path: '/session', name: 'session')]
    public function examens(ExamensRepository $repo, CompetencesRepository $repo2, InscriptionRepository $repo3): Response
    {        
        // $inscription = New Inscription();
        // $repo3->add($inscription,true);
        // $user = $this->getUser();
        // dd($user);

        $examens = $repo->findAll();

        $competences = $repo2->findAll();
        return $this->render('session/session.html.twig',['examens'=>$examens,'competences'=>$competences]);
    }


   #[Route('session/{id}', name: 'show', methods:'POST')]
public function show($id, ExamensRepository $repo, UserRepository $repo2) {
//    $id = $_POST['id'];
    $inscription = new Inscription();
    $user = $this->getUser();
    $examens = $repo->find($id);
    $u
    
    dd($examens);

   

//    $users = $repo->find($id);
//    $users = $repo->find($id);
//    $submit = $_POST['submit'];

//    if(isset($submit)) {
//    $inscription = New Inscription();
//    $repo->add($inscription);    
//    }

return $this->render('session/session.html.twig',['examens' => $examens, 'users' =>$users]);
}
   




    }