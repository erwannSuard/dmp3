<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactProject;
use App\Entity\Project;
use App\Entity\Contact;
use App\Entity\Funding;
use App\Entity\Romp;
use App\Form\ProjectType;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ResearchOutput;
use App\Form\ResearchOutputType;
class ResearchOutputController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/research-output', name: 'research_output')]
    public function index(Request $request): Response
    {
        //------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_USER');       
        //------------------------------------------------
        $ro = new ResearchOutput();
        $formRO = $this->createForm(ResearchOutputType::class, $ro);
        if($formRO->isSubmitted() && $formRO->isValid())
        {
            $ro = $formRO->getData();

            $this->entityManager->persist($ro);
            $this->entityManager->flush();
            return $this->render('homepage/index.html.twig', [
            ]);
        }

        return $this->renderForm('research_output/research-output.html.twig', [
            'formRO' => $formRO,
        ]);
    }
}
