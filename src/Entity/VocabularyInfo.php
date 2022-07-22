<?php

namespace App\Entity;

use App\Repository\VocabularyInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VocabularyInfoRepository::class)]
class VocabularyInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $vocabularyName;

    #[ORM\Column(type: 'text')]
    private $uri;

    #[ORM\ManyToMany(targetEntity: ResearchOutput::class, inversedBy: 'vocabularyInfos')]
    private $ResearchOutputs;

    public function __construct()
    {
        $this->ResearchOutputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVocabularyName(): ?string
    {
        return $this->vocabularyName;
    }

    public function setVocabularyName(?string $vocabularyName): self
    {
        $this->vocabularyName = $vocabularyName;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return Collection<int, ResearchOutput>
     */
    public function getResearchOutputs(): Collection
    {
        return $this->ResearchOutputs;
    }

    public function addResearchOutput(ResearchOutput $researchOutput): self
    {
        if (!$this->ResearchOutputs->contains($researchOutput)) {
            $this->ResearchOutputs[] = $researchOutput;
        }

        return $this;
    }

    public function removeResearchOutput(ResearchOutput $researchOutput): self
    {
        $this->ResearchOutputs->removeElement($researchOutput);

        return $this;
    }
}
