<?php

namespace App\Entity;

use App\Repository\CostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CostRepository::class)]
class Cost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', columnDefinition:"TEXT CHECK (type IN ('storage', 'archiving', 're-use', 'other'))")]
    private $type;

    #[ORM\Column(type: 'float')]
    private $value;

    #[ORM\Column(type: 'text')]
    private $unit;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'costs')]
    private $fundedBy;

    #[ORM\ManyToMany(targetEntity: ResearchOutput::class, inversedBy: 'costs')]
    private $ResearchOutput;



    public function __construct()
    {
        $this->ResearchOutput = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getFundedBy(): ?Contact
    {
        return $this->fundedBy;
    }

    public function setFundedBy(?Contact $fundedBy): self
    {
        $this->fundedBy = $fundedBy;

        return $this;
    }

    /**
     * @return Collection<int, ResearchOutput>
     */
    public function getResearchOutput(): Collection
    {
        return $this->ResearchOutput;
    }

    public function addResearchOutput(ResearchOutput $researchOutput): self
    {
        if (!$this->ResearchOutput->contains($researchOutput)) {
            $this->ResearchOutput[] = $researchOutput;
        }

        return $this;
    }

    public function removeResearchOutput(ResearchOutput $researchOutput): self
    {
        $this->ResearchOutput->removeElement($researchOutput);

        return $this;
    }

}
