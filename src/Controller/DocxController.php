<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\RompRepository;
use App\Entity\Romp;
use App\Entity\ResearchOutput;
use App\Repository\ResearchOutputRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DmpChoiceType;

class DocxController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/docx', name: 'docx')]
    public function index(Request $request, RompRepository $rompRep): Response
    {
        $romp = new Romp();
        $formDmp = $this->createForm(DmpChoiceType::class, $romp);
        $formDmp->handleRequest($request);
        if($formDmp->isSubmitted() && $formDmp->isValid())
        {
//            dd($formDmp->get('romp')->getData());

            $romp = $formDmp->get('romp')->getData();
            dd($romp);
            $doc = new PhpWord();
//            $romp = $rompRep->findOneBy(["versionRomp" => "PDT 1.0"]); // Logique à changer quand on pourra choisir le DMP à "imprimer" avec un formulaire
            dd($romp);
            $section = $doc->addSection();
            // 1. Data Summary
            $section->addText(
                "1. Data Summary : ",
                array('name' => 'Arial', 'size' => 14, 'bold' => true)
            );
            $docWrite = IOFactory::createWriter($doc, "Word2007");
            $doc->save("ok.docx", "Word2007", false); //dernier boolean sur true pour DownLoad
            exit;
        }
        return $this->renderForm('docx/index.html.twig', [
            'formRomp' => $formDmp,
        ]);


    }
}
