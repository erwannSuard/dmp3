<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {

        return $this->render('homepage/index.html.twig', [
        ]);
    }

    #[Route('/connected', name: 'connected')]
    public function connected(): Response
    {

        return $this->render('homepage/connected.html.twig', [
        ]);
    }

    #[Route('/authentication', name: 'authentication')]
    public function authentication(): Response
    {

        return $this->render('homepage/authentication.html.twig', [
        ]);
    }
}
