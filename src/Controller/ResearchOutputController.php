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
use App\Entity\Data;
use App\Entity\Service;
use App\Entity\MetadataInfo;
use App\Entity\Distribution;
use App\Entity\Embargo;
use App\Entity\Licence;
use App\Entity\Host;
use App\Entity\VocabularyInfo;
use App\Repository\VocabularyInfoRepository;



class ResearchOutputController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/research-output', name: 'research_output')]
    public function index(Request $request, VocabularyInfoRepository $vocabRepository): Response
    {
        //------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_USER');       
        //------------------------------------------------
        
        // Instance des Entity + Formulaires associés
        $ro = new ResearchOutput();
        $formRO = $this->createForm(ResearchOutputType::class, $ro);
        $formRO->handleRequest($request);
        $cost = new Cost();
        $data = new Data();
        $service = new Service();
        $metaData = new MetadataInfo();
        $distribution = new Distribution();
        $embargo = new Embargo();
        $licence = new Licence();
        $host = new Host();
        $vocabularyInfo = new VocabularyInfo();


        if($formRO->isSubmitted() && $formRO->isValid())
        {
            
            // dd($formRO->getData());
            // Remplissage des infos générales du RO
            $ro = $formRO->getData();
            $this->entityManager->persist($ro);

            // ---------- à rajouter : Transformer le vocab en array + IMPORTANT METADATA PLUSIEURS---------- 

            // Remplissage de l'entité MetaData + liaison au RO 
            $metaData = $formRO->get('metadata')->getData();
            $metaData->setResearchOutput($ro);
            $this->entityManager->persist($metaData);
            $ro->addMetadataInfo($metaData);
            // dd($ro);

            // Le RO est il une data ou un service ?
            $typeServiceOrData = $formRO->get('type')->getData();
            if ($typeServiceOrData == "dataSet")
            {
                $data = $formRO->get('data')->getData();
                $data->setResearchOutput($ro);
                $this->entityManager->persist($data);
                // dd($data);
            }
            else 
            {
                $service = $formRO->get('service')->getData();
                $service->setResearchOutput($ro);
                $this->entityManager->persist($service);
                // dd($service);
            }
            // Si Vocab, boucler à l'interieur
            
            foreach($formRO->get('vocabularyInfos') as $vocab)
            {
                // Check s'il existe déjà
                $uri = $vocab->getNormData()->getUri();
                $vocabTest = ($vocabRepository->findOneBy(['uri' => $uri]));
                if($vocabTest == null)
                {
                    $vocabularyInfo = $vocab->getData();
                    $vocabularyInfo->addResearchOutput($ro);
                    $this->entityManager->persist($vocabularyInfo);
                    $ro->addVocabularyInfo($vocabularyInfo);
                }
                else
                {
                    $vocabTest->addResearchOutput($ro);
                    $this->entityManager->persist($vocabTest);
                    $ro->addVocabularyInfo($vocabTest);
                }
            }
            // ---------- à rajouter : Distrib attention, problème support versionning, mettre un select ----------

            //J'EN SUIS LÀ EMBARGO
            // Boucle distribution 
            foreach($formRO->get('distribution') as $distrib)
            {
                $distribution = $distrib->getData();
                if ($distrib->get('access')->getData() == "embargo")
                {
                    $embargo->setStartDate($distrib->get('embargoStartDate')->getData());

                }
                dd($distribution);
            }
            dd($ro);
            // $this->entityManager->flush();
            return $this->render('homepage/index.html.twig', [
            ]);
        }

        return $this->renderForm('research_output/research-output.html.twig', [
            'formRO' => $formRO,
        ]);
    }
}
