<?php

namespace App\Entity;

use App\Repository\RompRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RompRepository::class)]
class Romp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $identifier;

    #[ORM\Column(type: 'date')]
    private $submissionDate;

    #[ORM\Column(type: 'text')]
    private $versionRomp;

    #[ORM\Column(type: 'text')]
    private $deliverable;

    #[ORM\Column(type: 'text', columnDefinition:"TEXT CHECK (licence_romp IN ('CC-BY-4.0', 'CC-BY-NC-4.0', 'CC-BY--ND-4.0', 'CC-BY--SA-4.0', 'CC0-1.0'))",
        options: [
            "default" => "CC-BY-4.0"
                ])]
    private $licenceRomp;

    #[ORM\Column(type: 'text')]
    private $ethicalIssues;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'romps')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'romps')]
    #[ORM\JoinColumn(nullable: false)]
    private $contact;

    #[ORM\OneToMany(mappedBy: 'romp', targetEntity: ResearchOutput::class)]
    private $researchOutputs;

    public function __construct()
    {
        $this->researchOutputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTimeInterface $submissionDate): self
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    public function getVersionRomp(): ?string
    {
        return $this->versionRomp;
    }

    public function setVersionRomp(string $versionRomp): self
    {
        $this->versionRomp = $versionRomp;

        return $this;
    }

    public function getDeliverable(): ?string
    {
        return $this->deliverable;
    }

    public function setDeliverable(string $deliverable): self
    {
        $this->deliverable = $deliverable;

        return $this;
    }

    public function getLicenceRomp(): ?string
    {
        return $this->licenceRomp;
    }

    public function setLicenceRomp(string $licenceRomp): self
    {
        $this->licenceRomp = $licenceRomp;

        return $this;
    }

    public function getEthicalIssues(): ?string
    {
        return $this->ethicalIssues;
    }

    public function setEthicalIssues(string $ethicalIssues): self
    {
        $this->ethicalIssues = $ethicalIssues;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection<int, ResearchOutput>
     */
    public function getResearchOutputs(): Collection
    {
        return $this->researchOutputs;
    }

    public function addResearchOutput(ResearchOutput $researchOutput): self
    {
        if (!$this->researchOutputs->contains($researchOutput)) {
            $this->researchOutputs[] = $researchOutput;
            $researchOutput->setRomp($this);
        }

        return $this;
    }

    public function removeResearchOutput(ResearchOutput $researchOutput): self
    {
        if ($this->researchOutputs->removeElement($researchOutput)) {
            // set the owning side to null (unless already changed)
            if ($researchOutput->getRomp() === $this) {
                $researchOutput->setRomp(null);
            }
        }

        return $this;
    }
}
