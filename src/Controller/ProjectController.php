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
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $project = $form->getData();
            $contact = $form->get('idContact')->getData();
            // dd($contact);
            $cp->setProject($project);
            $cp->setContact($contact);
            $cp->setRoleContact("Coordinator");
            $this->entityManager->persist($cp);
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            dd($cp);
            $contact = $form->get('idContact')->getData();
            $contact->addIdProject($project);
            $project->addIdContact($contact);
            // dd($form->get('idContact'));
            // dd($contact);
            // $project = $form->getData();
            $this->entityManager->persist($project);
            // dd($project);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->renderForm('project/index.html.twig', [
            'form' => $form,
        ]);
    }
}
