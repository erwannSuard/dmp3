<?php

namespace App\Entity;

use App\Repository\FundingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FundingRepository::class)]
class Funding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'bigint')]
    private $grantFunding;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'fundings')]
    #[ORM\JoinColumn(nullable: false)]
    private $funder;

    #[ORM\OneToOne(mappedBy: 'funding', targetEntity: Project::class, cascade: ['persist', 'remove'])]
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrantFunding(): ?string
    {
        return $this->grantFunding;
    }

    public function setGrantFunding(string $grantFunding): self
    {
        $this->grantFunding = $grantFunding;

        return $this;
    }

    public function getFunder(): ?Contact
    {
        return $this->funder;
    }

    public function setFunder(?Contact $funder): self
    {
        $this->funder = $funder;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        // unset the owning side of the relation if necessary
        if ($project === null && $this->project !== null) {
            $this->project->setFunding(null);
        }

        // set the owning side of the relation if necessary
        if ($project !== null && $project->getFunding() !== $this) {
            $project->setFunding($this);
        }

        $this->project = $project;

        return $this;
    }
}
