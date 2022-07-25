<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ResearchOutput;
use App\Form\ResearchOutputType;
use App\Entity\Cost;
use App\Form\CostType;
use App\Entity\Data;
use App\Form\DataType;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Entity\MetadataInfo;
use App\Form\MetadataInfoType;
use App\Entity\Distribution;
use App\Form\DistributionType;
use App\Entity\Embargo;
use App\Form\EmbargoType;



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
        
        // Instance des Entity + Formulaires associés
        $ro = new ResearchOutput();
        $formRO = $this->createForm(ResearchOutputType::class, $ro);
        $cost = new Cost();
        $formCost = $this->createForm(CostType::class, $cost);
        $data = new Data();
        $formData = $this->createForm(DataType::class, $data);
        $service = new Service();
        $formService = $this->createForm(ServiceType::class, $service);
        $metaData = new MetadataInfo();
        $formMetaData = $this->createForm(MetadataInfoType::class, $metaData);
        $distrib = new Distribution();
        $formDistrib = $this->createForm(DistributionType::class, $distrib);
        $embargo = new Embargo();
        $formEmbargo = $this->createForm(EmbargoType::class, $embargo);



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
            'formCost' => $formCost,
            'formData' => $formData,
            'formService' => $formService,
            'formMetaData' => $formMetaData,
            'formDistrib' => $formDistrib,
            'formEmbargo' => $formEmbargo,
        ]);
    }
}
