<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\ExamensRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Config\Framework\HttpClient\DefaultOptions\RetryFailedConfig;

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
    public function examens(ExamensRepository $repo,CompetencesRepository $repo2): Response
    {
        $examens = $repo->findAll();
        $competences = $repo2->findAll();
        $u
        return $this->render('session/session.html.twig',['examens'=>$examens,'competences'=>$competences]);
    }

   


    // #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
    // public function delete(Request $request, User $user, UserRepository $userRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //         $this->container->get('security.token_storage')->setToken(null);
    //         $userRepository->remove($user, true);
    //     }
    //    $this->addFlash('deleted','Votre compte a été supprimé.');
    //     return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    // }

   


}
