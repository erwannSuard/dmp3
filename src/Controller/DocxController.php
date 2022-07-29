<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Shared\Html;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DocxController extends AbstractController
{   
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/docx', name: 'docx')]
    public function index(Request $request, ProjectRepository $projectRep): Response
    {
        $project = new Project();
        $project = $projectRep->findOneBy(['title' => 'FAIRYZ']);
        $doc = new PhpWord();
        
        // $phpHtml = new Html();
        $section = $doc->addSection();
        $section->addText(
            "Project Title : " . $project->getTitle(),
            array('name' => 'Arial', 'size' => 70)
        );
        $docWrite = IOFactory::createWriter($doc, "Word2007");
        $doc->save("ok.docx", "Word2007", true);
        exit;
        return $this->render('docx/index.html.twig', [
            'controller_name' => 'DocxController',
        ]);
    }
}
