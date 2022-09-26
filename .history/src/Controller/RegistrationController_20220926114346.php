<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\ExamensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/registerExam', name: 'registeredExam')] 
    public function registerToExam(Request $request, ExamensRepository $repo ) {
        $submit = $request->get('submit');
        $isRegistered = $this->getUser(); //recupere info de la base de donnees

        if(!isset($submit)){

            return $this->render('tache/create.html.twig', ['isRegistered'=>$isRegistered]);
        }

        $email = $request->get('email'); //recuperer info envoyé par formulaire
        $isRegistered = new Inscription();
        $isRegistered->setEmail($email)->setComplete((false));
        $repo->add($tache,true); //insertion dans la base données

        return $this->redirect('/tache/create');
    }
}
