<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use App\Entity\Romp;
use App\Form\RompType;
use App\Entity\Contact;
use App\Entity\ContactProject;
use App\Repository\ProjectRepository;

class RompController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/romp', name: 'romp')]
    public function index(Request $request, ProjectRepository $projectRep): Response
    {

        //------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_ADMIN');       
        //------------------------------------------------
        // S'il n'y a pas de projet créé, on redirige vers une page d'erreur qui demande d'en créer un
        $testProject = $projectRep->findBy(['parentProject' => null]);
        if(empty($testProject))
        {
            return $this->render('romp/erreur.html.twig', [
                'controller_name' => 'RompController',
            ]);
        }
 
        // Sinon, on continue 
        $romp = new Romp();
        // Contact et projet associé
        $dmpLeader = new Contact();
        $project = new Project();
        $contactProject = new ContactProject();
        // Création du formulaire
        $formRomp = $this->createForm(RompType::class, $romp);
        $formRomp->handleRequest($request);

        // Si formulaire soumis et valide 
        if($formRomp->isSubmitted() && $formRomp->isValid())
        {
            $project = $formRomp->get('project')->getData();
            $dmpLeader = $formRomp->get('contactRomp')->getData();
            $romp = $formRomp->getData();
            $romp->setContact($dmpLeader);
            $project->addRomp($romp);
            $contactProject->setProject($project);
            $contactProject->setContact($dmpLeader);
            $contactProject->setRoleContact("DMP_Leader");

            $this->entityManager->persist($contactProject);
            $this->entityManager->persist($romp);
            
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }


        return $this->renderForm('romp/romp.html.twig', [
                'formRomp' => $formRomp,
        ]);
   
    }
}
