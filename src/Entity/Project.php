<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $title;

    #[ORM\Column(type: 'text')]
    private $abstract;

    #[ORM\Column(type: 'text', nullable: true)]
    private $acronym;

    #[ORM\Column(type: 'date')]
    private $startDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $duration;

    #[ORM\Column(type: 'text', nullable: true)]
    private $website;

    #[ORM\Column(type: 'text', nullable: true)]
    private $objectives;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ContactProject::class, orphanRemoval: true)]
    private $contacts;

    #[ORM\OneToOne(inversedBy: 'project', targetEntity: Funding::class, cascade: ['persist', 'remove'])]
    private $funding;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Romp::class, orphanRemoval: true)]
    private $romps;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->romps = new ArrayCollection();
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

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    public function setAcronym(?string $acronym): self
    {
        $this->acronym = $acronym;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getObjectives(): ?string
    {
        return $this->objectives;
    }

    public function setObjectives(?string $objectives): self
    {
        $this->objectives = $objectives;

        return $this;
    }

    /**
     * @return Collection<int, ContactProject>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(ContactProject $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setProject($this);
        }

        return $this;
    }

    public function removeContact(ContactProject $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getProject() === $this) {
                $contact->setProject(null);
            }
        }

        return $this;
    }

    public function getFunding(): ?Funding
    {
        return $this->funding;
    }

    public function setFunding(?Funding $funding): self
    {
        $this->funding = $funding;

        return $this;
    }

    /**
     * @return Collection<int, Romp>
     */
    public function getRomps(): Collection
    {
        return $this->romps;
    }

    public function addRomp(Romp $romp): self
    {
        if (!$this->romps->contains($romp)) {
            $this->romps[] = $romp;
            $romp->setProject($this);
        }

        return $this;
    }

    public function removeRomp(Romp $romp): self
    {
        if ($this->romps->removeElement($romp)) {
            // set the owning side to null (unless already changed)
            if ($romp->getProject() === $this) {
                $romp->setProject(null);
            }
        }

        return $this;
    }
}
