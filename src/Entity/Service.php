<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $typeOfService;

    #[ORM\Column(type: 'integer')]
    private $endProjectTrl;

    #[ORM\OneToOne(targetEntity: ResearchOutput::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $researchOutput;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfService(): ?string
    {
        return $this->typeOfService;
    }

    public function setTypeOfService(string $typeOfService): self
    {
        $this->typeOfService = $typeOfService;

        return $this;
    }

    public function getEndProjectTrl(): ?int
    {
        return $this->endProjectTrl;
    }

    public function setEndProjectTrl(int $endProjectTrl): self
    {
        $this->endProjectTrl = $endProjectTrl;

        return $this;
    }

    public function getResearchOutput(): ?ResearchOutput
    {
        return $this->researchOutput;
    }

    public function setResearchOutput(ResearchOutput $researchOutput): self
    {
        $this->researchOutput = $researchOutput;

        return $this;
    }
}
