<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestProjectController extends AbstractController
{
    #[Route('/test/project', name: 'app_test_project')]
    public function index(): Response
    {
        return $this->render('test_project/index.html.twig', [
            'controller_name' => 'TestProjectController',
        ]);
    }
}
