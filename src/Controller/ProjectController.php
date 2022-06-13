<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactProject;
use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/project', name: 'project')]
    public function index(Request $request): Response
    {
        $cp = new ContactProject();
        $project = new Project();
        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);

        if($formProject->isSubmitted() && $formProject->isValid())
        {
            $project = $formProject->getData();
            $contact = $formProject->get('idContact')->getData();
            // dd($contact);
            $cp->setProject($project);
            $cp->setContact($contact);
            $cp->setRoleContact("Coordinator");
            $this->entityManager->persist($cp);
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            dd($cp);
            $contact = $formProject->get('idContact')->getData();
            $contact->addIdProject($project);
            $project->addIdContact($contact);
            // dd($formProject->get('idContact'));
            // dd($contact);
            // $project = $formProject->getData();
            $this->entityManager->persist($project);
            // dd($project);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->renderForm('project/index.html.twig', [
            'formProject' => $formProject,
        ]);
    }
}
