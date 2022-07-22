<?php

namespace App\Entity;

use App\Repository\DistributionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistributionRepository::class)]
class Distribution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', columnDefinition:"TEXT CHECK (access IN ('open default', 'onDemand', 'embargo'))",
    )]
    private $access;

    #[ORM\Column(type: 'text')]
    private $accessUrl;

    #[ORM\Column(type: 'text')]
    private $accessProtocol;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sizeValue;

    #[ORM\Column(type: 'text', columnDefinition:"TEXT CHECK (size_unit IN ('Ko', 'Mo', 'Go', 'To', 'Po'))",
    )]
    private $sizeUnit;

    #[ORM\Column(type: 'text', nullable: true)]
    private $format;

    #[ORM\Column(type: 'text', nullable: true)]
    private $downloadUrl;

    #[ORM\OneToOne(targetEntity: Embargo::class, cascade: ['persist', 'remove'])]
    private $embargo;

    #[ORM\ManyToOne(targetEntity: ResearchOutput::class, inversedBy: 'distributions')]
    #[ORM\JoinColumn(nullable: false)]
    private $researchOutput;

    #[ORM\ManyToOne(targetEntity: Licence::class, inversedBy: 'distributions')]
    #[ORM\JoinColumn(nullable: false)]
    private $licence;

    #[ORM\ManyToOne(targetEntity: Host::class, inversedBy: 'distribution')]
    private $host;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccess(): ?string
    {
        return $this->access;
    }

    public function setAccess(?string $access): self
    {
        $this->access = $access;

        return $this;
    }

    public function getAccessUrl(): ?string
    {
        return $this->accessUrl;
    }

    public function setAccessUrl(string $accessUrl): self
    {
        $this->accessUrl = $accessUrl;

        return $this;
    }

    public function getAccessProtocol(): ?string
    {
        return $this->accessProtocol;
    }

    public function setAccessProtocol(string $accessProtocol): self
    {
        $this->accessProtocol = $accessProtocol;

        return $this;
    }

    public function getSizeValue(): ?int
    {
        return $this->sizeValue;
    }

    public function setSizeValue(?int $sizeValue): self
    {
        $this->sizeValue = $sizeValue;

        return $this;
    }

    public function getSizeUnit(): ?string
    {
        return $this->sizeUnit;
    }

    public function setSizeUnit(?string $sizeUnit): self
    {
        $this->sizeUnit = $sizeUnit;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    public function setDownloadUrl(?string $downloadUrl): self
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    public function getEmbargo(): ?Embargo
    {
        return $this->embargo;
    }

    public function setEmbargo(?Embargo $embargo): self
    {
        $this->embargo = $embargo;

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

    public function getLicence(): ?Licence
    {
        return $this->licence;
    }

    public function setLicence(?Licence $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): self
    {
        $this->host = $host;

        return $this;
    }
}
