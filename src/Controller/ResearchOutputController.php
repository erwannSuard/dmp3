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
use App\Repository\HostRepository;
use App\Repository\LicenceRepository;
use App\Repository\RompRepository;
use App\Entity\Romp;

class ResearchOutputController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/research-output', name: 'research_output')]
    public function index(Request $request, VocabularyInfoRepository $vocabRepository, HostRepository $hostRepository, LicenceRepository $licenceRepository): Response
    {
        //------------------------------------------------
        //Sécurité accès
        $this->denyAccessUnlessGranted('ROLE_USER');       
        //------------------------------------------------
        
        // Instance RO
        $ro = new ResearchOutput();
        $formRO = $this->createForm(ResearchOutputType::class, $ro);
        $formRO->handleRequest($request);
        
        


        if($formRO->isSubmitted() && $formRO->isValid())
        {
            
            // Remplissage des infos générales du RO
            $ro = $formRO->getData();
            $workPackage = $formRO->get('workPackage')->getData();
            $ro->setWorkPackage($workPackage);
            $romp = new Romp();
            $romp = $formRO->get('romp')->getData();
            $ro->setRomp($romp);
            $romp->addResearchOutput($ro);
            
            // Slice des keywords :
            $keywordsFullText = $formRO->get('keyword')->getData();
            $keywordBaseArray = explode(",", $keywordsFullText);
            $keywordFinalArray = [];
            // Nettoyage des valeurs vides et espaces
            foreach($keywordBaseArray as $kw)
            {
                $kw = trim($kw);
                if($kw != "")
                {
                    array_push($keywordFinalArray, $kw);
                }
            }
            // dd($keywordFinalArray);
            $ro->setKeyword($keywordFinalArray);
            // $this->entityManager->persist($ro);

            // ---------- à rajouter : Transformer le vocab en array + METADATA PLUSIEURS ("bonus")---------- 



            // ----- Remplissage de l'entité MetaData + liaison au RO 
            $metaData = new MetadataInfo();
            $metaData = $formRO->get('metadata')->getData();
            $metaData->setResearchOutput($ro);
            $this->entityManager->persist($metaData); // Persist MetaData
            $ro->addMetadataInfo($metaData);
            // dd($ro);



            // ----- Le RO est il une data ou un service ?
            $typeServiceOrData = $formRO->get('type')->getData();
            if ($typeServiceOrData == "dataSet")
            {
                $data = new Data();
                $data = $formRO->get('data')->getData();
                $data->setResearchOutput($ro);
                $this->entityManager->persist($data); // Persist Data
                // dd($data);
            }
            else 
            {
                $service = new Service();
                $service = $formRO->get('service')->getData();
                $service->setResearchOutput($ro);
                $this->entityManager->persist($service); // Persist Service
                // dd($service);
            }


            
            // Si Vocab, boucler à l'interieur
            foreach($formRO->get('vocabularyInfos') as $vocab)
            {
                $vocabularyInfo = new VocabularyInfo();
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


            // ----- Boucle distribution 
            foreach($formRO->get('distribution') as $distrib)
            {
                $distribution = new Distribution();
                $distribution = $distrib->getData();

                // ----- Remplissage de l'entité Embargo (si embargo)
                if ($distrib->get('access')->getData() == "embargo")
                {
                    $embargo = new Embargo();
                    $embargo->setStartDate($distrib->get('embargoStartDate')->getData());
                    $embargo->setEndDate($distrib->get('embargoEndDate')->getData());
                    $embargo->setLegalAndContractualReasons($distrib->get('embargoLegalAndContractualReasons')->getData());
                    $embargo->setIntentionalRestrictions($distrib->get('embargoIntentionalRestrictions')->getData());
                    $this->entityManager->persist($embargo); // Persist Embargo
                    $distribution->setEmbargo($embargo);
                }
                

                // ----- Remplissage de l'entité Host
                // Vérification si pré-existence
                $hostUrl = $distrib->get('hostUrl')->getData();
                $hostTest = ($hostRepository->findOneBy(['hostUrl' => $hostUrl]));
                $host = new Host();
                if($hostTest == null) // Si n'existe pas déjà, on le créé
                {   
                    $host->setHostName($distrib->get('hostName')->getData());
                    $host->setHostDescription($distrib->get('hostDescription')->getData());
                    $host->setHostUrl($distrib->get('hostUrl')->getData());
                    $host->setPidSystem($distrib->get('pidSystem')->getData());
                    $host->setSupportVersionning($distrib->get('supportVersionning')->getData());
                    $host->setCertifiedWith($distrib->get('certifiedWith')->getData());
                }

                else // Sinon, on l'associe à l'existant
                {
                    $host = $hostTest;
                }
                $host->addDistribution($distribution);
                $distribution->setHost($host);
                $this->entityManager->persist($host); // Persist Host



                // ----- Remplissage de l'entité Licence
                // Vérification si pré-existence
                $licence = new Licence();
                $licenceName = $distrib->get('licenceName')->getData();
                $licenceTest = ($licenceRepository->findOneBy(['name' => $licenceName]));

                if($licenceTest == null) // Si n'existe pas déjà, on le créé
                {
                    $licence->setName($distrib->get('licenceName')->getData());
                    $licence->setUrl($distrib->get('hostDescription')->getData());
                    
                    $this->entityManager->persist($licence);
                }

                else // Sinon, on l'associe à l'existant
                {
                    $licence = $licenceTest;
                }
                $licence->addDistribution($distribution);
                $distribution->setLicence($licence);
                $this->entityManager->persist($distribution); // Persist Distribution
                $ro->addDistribution($distribution);
                // dd($distribution);
            }
            // dd($ro);
            // if COST
            if ($formRO->get('costs')->getData() == false) // (Si on a une entité cost)
            {
                
                $cost = new Cost();
                $cost = $formRO->get('cost')->getData();
                $cost->addResearchOutput($ro);
                $ro->addCost($cost);
                // dd($cost);
            }
            
            $this->entityManager->persist($ro);
            $romp->addResearchOutput($ro);
            // dd($ro);
            $this->entityManager->flush();
            return $this->render('homepage/index.html.twig', [
            ]);
        }

        return $this->renderForm('research_output/research-output.html.twig', [
            'formRO' => $formRO,
        ]);
    }
}
