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
//------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
//------------------------------------------------

        //Création des instances de projet, contact et de liaison des deux.
        $cp = new ContactProject();
        $project = new Project();
        $contact = new Contact();
        // $contactRomp = new Contact();
        //Création instances funding et Romp
        // $romp = new Romp();
        $funding = new Funding();
        // $cpRomp = new ContactProject();
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
            //Ajout des données aux attributs
            // $romp = $formProject->get('romp')->getData();
            // $romp = $romp['romp'];
            $funding = $formProject->get('funding')->getData();
            $project = $formProject->getData();
            $contact = $formProject->get('idContact')->getData();
            // $contactRomp = $formProject['romp']['romp']['contactRomp']->getNormData();
            // dd($romp);
            //Associations
            $project->setFunding($funding['project']);
            //Association Contact <-> Coordinateur
            $cp->setProject($project);
            $cp->setContact($contact);
            $cp->setRoleContact("Coordinator");
            //Association Contact <-> DMP Leader
            // $project->addRomp($romp);
            // $contactRomp->addRomp($romp);
            // $cpRomp->setProject($project);
            // $cpRomp->setContact($contactRomp);
            // $cpRomp->setRoleContact('DMP_Leader');
            //Persist les données
            // $this->entityManager->persist($romp);
            $this->entityManager->persist($cp);
            // $this->entityManager->persist($cpRomp);
            $this->entityManager->persist($project);

            //Boucler dans les WP + index pour trouver le bon contact en charge du wp:
            $i=0;
            foreach($formProject->get('idRefProject')->getData() as $wp)
            {

                $cp = new ContactProject();
                $cct = new Contact();
                $cct = $formProject['idRefProject'][$i]['idContact']->getNormData();
                $workPackage = new Project();
                $workPackage = $wp;
                $workPackage->setParentProject($project);
                $cp->setProject($wp);
                $cp->setContact($cct);
                $cp->setRoleContact("WP_Leader");
                //JUSTE TANT QUE L'ACRONYME EST NON NULLABLE
                $workPackage->setAcronym($project->getAcronym());
                $this->entityManager->persist($workPackage);
                $this->entityManager->persist($cct);
                $this->entityManager->persist($cp);
                $i+=1;
            }
            $this->entityManager->flush();

            return $this->redirectToRoute('success');
        }
        return $this->renderForm('project/index.html.twig', [
            'formProject' => $formProject,
            'formContact' => $formContact,
        ]);
    }
}
