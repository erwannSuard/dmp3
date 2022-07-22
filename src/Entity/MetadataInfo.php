<?php

namespace App\Entity;

use App\Repository\MetadataInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetadataInfoRepository::class)]
class MetadataInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'text', nullable: true)]
    private $standardName;

    #[ORM\Column(type: 'text')]
    private $api;

    #[ORM\ManyToOne(targetEntity: ResearchOutput::class, inversedBy: 'metadataInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private $researchOutput;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStandardName(): ?string
    {
        return $this->standardName;
    }

    public function setStandardName(?string $standardName): self
    {
        $this->standardName = $standardName;

        return $this;
    }

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(string $api): self
    {
        $this->api = $api;

        return $this;
    }

    public function getResearchOutput(): ?ResearchOutput
    {
        return $this->researchOutput;
    }

    public function setResearchOutput(?ResearchOutput $researchOutput): self
    {
        $this->researchOutput = $researchOutput;

        return $this;
    }
}
