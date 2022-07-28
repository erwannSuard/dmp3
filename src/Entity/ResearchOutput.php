<?php

namespace App\Entity;

use App\Repository\ResearchOutputRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResearchOutputRepository::class)]
class ResearchOutput
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $title;

    #[ORM\Column(type: 'text', columnDefinition:"TEXT CHECK (type IN ('dataSet', 'service'))")]
    private $type;

    #[ORM\Column(type: 'text', nullable: true)]
    private $identifier;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'text', nullable: true)]
    private $standardUsed;

    #[ORM\Column(type: 'boolean')]
    private $reused;

    #[ORM\Column(type: 'text', nullable: true)]
    private $lineage;

    #[ORM\Column(type: 'text', nullable: true)]
    private $utility;

    #[ORM\Column(type: 'date', nullable: true)]
    private $issued;

    #[ORM\Column(type: 'text')]
    private $language;

    #[ORM\ManyToMany(targetEntity: Cost::class, mappedBy: 'ResearchOutput')]
    private $costs;

    #[ORM\Column(type: 'simple_array')]
    private $keyword = [];

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'researchOutputs')]
    private $contacts;

    #[ORM\OneToMany(mappedBy: 'researchOutput', targetEntity: MetadataInfo::class)]
    private $metadataInfos;

    #[ORM\ManyToMany(targetEntity: VocabularyInfo::class, mappedBy: 'ResearchOutputs')]
    private $vocabularyInfos;


    #[ORM\OneToMany(mappedBy: 'researchOutput', targetEntity: Distribution::class)]
    private $distributions;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'researchOutputs')]
    private $ROReference;

    #[ORM\ManyToOne(targetEntity: Romp::class, inversedBy: 'researchOutputs')]
    private $romp;

    // #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'ROReference')]
    // private $researchOutputs;

    public function __construct()
    {
        $this->costs = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->metadataInfos = new ArrayCollection();
        $this->vocabularyInfos = new ArrayCollection();
        $this->distributions = new ArrayCollection();
        $this->ROReference = new ArrayCollection();
        // $this->researchOutputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStandardUsed(): ?string
    {
        return $this->standardUsed;
    }

    public function setStandardUsed(?string $standardUsed): self
    {
        $this->standardUsed = $standardUsed;

        return $this;
    }

    public function isReused(): ?bool
    {
        return $this->reused;
    }

    public function setReused(bool $reused): self
    {
        $this->reused = $reused;

        return $this;
    }

    public function getLineage(): ?string
    {
        return $this->lineage;
    }

    public function setLineage(?string $lineage): self
    {
        $this->lineage = $lineage;

        return $this;
    }

    public function getUtility(): ?string
    {
        return $this->utility;
    }

    public function setUtility(?string $utility): self
    {
        $this->utility = $utility;

        return $this;
    }

    public function getIssued(): ?\DateTimeInterface
    {
        return $this->issued;
    }

    public function setIssued(?\DateTimeInterface $issued): self
    {
        $this->issued = $issued;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection<int, Cost>
     */
    public function getCosts(): Collection
    {
        return $this->costs;
    }

    public function addCost(Cost $cost): self
    {
        if (!$this->costs->contains($cost)) {
            $this->costs[] = $cost;
            $cost->addResearchOutput($this);
        }

        return $this;
    }

    public function removeCost(Cost $cost): self
    {
        if ($this->costs->removeElement($cost)) {
            $cost->removeResearchOutput($this);
        }

        return $this;
    }

    public function getKeyword(): ?array
    {
        return $this->keyword;
    }

    public function setKeyword(array $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection<int, MetadataInfo>
     */
    public function getMetadataInfos(): Collection
    {
        return $this->metadataInfos;
    }

    public function addMetadataInfo(MetadataInfo $metadataInfo): self
    {
        if (!$this->metadataInfos->contains($metadataInfo)) {
            $this->metadataInfos[] = $metadataInfo;
            $metadataInfo->setResearchOutput($this);
        }

        return $this;
    }

    public function removeMetadataInfo(MetadataInfo $metadataInfo): self
    {
        if ($this->metadataInfos->removeElement($metadataInfo)) {
            // set the owning side to null (unless already changed)
            if ($metadataInfo->getResearchOutput() === $this) {
                $metadataInfo->setResearchOutput(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VocabularyInfo>
     */
    public function getVocabularyInfos(): Collection
    {
        return $this->vocabularyInfos;
    }

    public function addVocabularyInfo(VocabularyInfo $vocabularyInfo): self
    {
        if (!$this->vocabularyInfos->contains($vocabularyInfo)) {
            $this->vocabularyInfos[] = $vocabularyInfo;
            $vocabularyInfo->addResearchOutput($this);
        }

        return $this;
    }

    public function removeVocabularyInfo(VocabularyInfo $vocabularyInfo): self
    {
        if ($this->vocabularyInfos->removeElement($vocabularyInfo)) {
            $vocabularyInfo->removeResearchOutput($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, Distribution>
     */
    public function getDistributions(): Collection
    {
        return $this->distributions;
    }

    public function addDistribution(Distribution $distribution): self
    {
        if (!$this->distributions->contains($distribution)) {
            $this->distributions[] = $distribution;
            $distribution->setResearchOutput($this);
        }

        return $this;
    }

    public function removeDistribution(Distribution $distribution): self
    {
        if ($this->distributions->removeElement($distribution)) {
            // set the owning side to null (unless already changed)
            if ($distribution->getResearchOutput() === $this) {
                $distribution->setResearchOutput(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getROReference(): Collection
    {
        return $this->ROReference;
    }

    public function addROReference(self $rOReference): self
    {
        if (!$this->ROReference->contains($rOReference)) {
            $this->ROReference[] = $rOReference;
        }

        return $this;
    }

    public function removeROReference(self $rOReference): self
    {
        $this->ROReference->removeElement($rOReference);

        return $this;
    }

    // /**
    //  * @return Collection<int, self>
    //  */
    // public function getResearchOutputs(): Collection
    // {
    //     return $this->researchOutputs;
    // }

    // public function addResearchOutput(self $researchOutput): self
    // {
    //     if (!$this->researchOutputs->contains($researchOutput)) {
    //         $this->researchOutputs[] = $researchOutput;
    //         $researchOutput->addROReference($this);
    //     }

    //     return $this;
    // }

    // public function removeResearchOutput(self $researchOutput): self
    // {
    //     if ($this->researchOutputs->removeElement($researchOutput)) {
    //         $researchOutput->removeROReference($this);
    //     }

    //     return $this;
    // }

    public function getRomp(): ?Romp
    {
        return $this->romp;
    }

    public function setRomp(?Romp $romp): self
    {
        $this->romp = $romp;

        return $this;
    }
}
