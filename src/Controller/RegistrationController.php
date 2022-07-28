<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\RegistrationFormType;
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
        //Création de Contact et User
        $user = new User();
        $contact = new Contact();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ------------------------
            //Prendre le mail (Attention, doublon pour l'instant)
            // ------------------------
            $dataFormContact = $form->get('contact')->getData();
            $dataFormContact = $dataFormContact["contact"];
            $user->setEmail($dataFormContact->getMail());

            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $contact = $dataFormContact;
            // // Pour tricher et créer un admin
             $user->setContact($contact);
             $userRole = [];
             array_push($userRole, $form->get('role')->getData());
             $user->setRoles($userRole);
            // // fin triche, à commenter pour créer un User basique
            $entityManager->persist($contact);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
