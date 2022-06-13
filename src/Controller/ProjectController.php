<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactProject;
use App\Entity\Project;
use App\Entity\Contact;
use App\Entity\Funding;
use App\Form\ProjectType;
use App\Form\ContactType;
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
        //Création des instances de projet, contact et de liaison des deux.
        $cp = new ContactProject();
        $project = new Project();
        $contact = new Contact();
        $funding = new Funding();
        //Formulaire projet + contact (caché de base)
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);
        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);


        //Le formulaire de contact au cas où le contact n'est pas renseigné dans la liste
        //Si le contact est soumis et valide :
        if($formContact->isSubmitted() && $formContact->isValid())
        {
            //Attribut contact = champs formulaire
            $contact = $formContact->getData();

            //Envoi du contact dans la bd
            $this->entityManager->persist($contact);
            $this->entityManager->flush();
            //Unset les champs d'input
            unset($contact);
            unset($formContact);
            $contact = new Contact();
            $formContact = $this->createForm(ContactType::class, $contact);

            //Return la même page
            return $this->renderForm('project/index.html.twig', [
                'formProject' => $formProject,
                'formContact' => $formContact,
            ]);
        }

        //Si le projet est soumis et valide :
        if($formProject->isSubmitted() && $formProject->isValid())
        {
            $funding = $formProject->get('funding')->getData();
            dd($funding);
            $project = $formProject->getData();
            $contact = $formProject->get('idContact')->getData();
            $cp->setProject($project);
            $cp->setContact($contact);
            $cp->setRoleContact("Coordinator");
            $this->entityManager->persist($cp);
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            
            

            return $this->redirectToRoute('homepage');
        }
        return $this->renderForm('project/index.html.twig', [
            'formProject' => $formProject,
            'formContact' => $formContact,
        ]);
    }
}
