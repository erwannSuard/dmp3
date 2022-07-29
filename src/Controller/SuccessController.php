<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuccessController extends AbstractController
{
    #[Route('/success', name: 'success')]
    public function success(): Response
    {

        return $this->render('homepage/index.html.twig', [
        ]);
    }
}
