<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
class ContactController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
//------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_USER');
//------------------------------------------------

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form-> isValid())
        {
            $contact = $form->getData();
            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            return $this->redirectToRoute('success');
        }
        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
