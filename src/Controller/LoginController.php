<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authUtils): Response
    {   
        //Erreur de login s'il y en a une
        $error = $authUtils->getLastAuthenticationError();

        //Dernier user
        $lastUser = $authUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'lastUser' => $lastUser,
            'error' => $error,
        ]);
    }
}
