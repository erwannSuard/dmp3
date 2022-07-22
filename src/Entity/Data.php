<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
class Data
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $sensitiveData;

    #[ORM\Column(type: 'boolean')]
    private $personalData;

    #[ORM\Column(type: 'text', nullable: true)]
    private $dataSecurity;

    #[ORM\OneToOne(inversedBy: 'data', targetEntity: ResearchOutput::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $researchOutput;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSensitiveData(): ?bool
    {
        return $this->sensitiveData;
    }

    public function setSensitiveData(bool $sensitiveData): self
    {
        $this->sensitiveData = $sensitiveData;

        return $this;
    }

    public function isPersonalData(): ?bool
    {
        return $this->personalData;
    }

    public function setPersonalData(bool $personalData): self
    {
        $this->personalData = $personalData;

        return $this;
    }

    public function getDataSecurity(): ?string
    {
        return $this->dataSecurity;
    }

    public function setDataSecurity(?string $dataSecurity): self
    {
        $this->dataSecurity = $dataSecurity;

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
