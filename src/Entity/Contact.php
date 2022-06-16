<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $lastName;

    #[ORM\Column(type: 'text', nullable: true)]
    private $firstName;

    #[ORM\Column(type: 'text')]
    private $mail;

    #[ORM\Column(type: 'text')]
    private $affiliation;

    #[ORM\Column(type: 'text', nullable: true)]
    private $laboratoryOrDepartment;

    #[ORM\Column(type: 'text', nullable: true)]
    private $identifier;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: ContactProject::class, orphanRemoval: true)]
    private $projects;

    #[ORM\OneToMany(mappedBy: 'funder', targetEntity: Funding::class, orphanRemoval: true)]
    private $fundings;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Romp::class, orphanRemoval: true)]
    private $romps;

    #[ORM\OneToOne(inversedBy: 'contact', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $userAuth;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->fundings = new ArrayCollection();
        $this->romps = new ArrayCollection();
    }

    public function __toString()
    {
        $res = '';
        $this->firstName ? $res = $this->lastName . ' ' . $this->firstName : $res = $this->lastName;
        return $res;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getLaboratoryOrDepartment(): ?string
    {
        return $this->laboratoryOrDepartment;
    }

    public function setLaboratoryOrDepartment(?string $laboratoryOrDepartment): self
    {
        $this->laboratoryOrDepartment = $laboratoryOrDepartment;

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

    /**
     * @return Collection<int, ContactProject>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(ContactProject $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setContact($this);
        }

        return $this;
    }

    public function removeProject(ContactProject $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getContact() === $this) {
                $project->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Funding>
     */
    public function getFundings(): Collection
    {
        return $this->fundings;
    }

    public function addFunding(Funding $funding): self
    {
        if (!$this->fundings->contains($funding)) {
            $this->fundings[] = $funding;
            $funding->setFunder($this);
        }

        return $this;
    }

    public function removeFunding(Funding $funding): self
    {
        if ($this->fundings->removeElement($funding)) {
            // set the owning side to null (unless already changed)
            if ($funding->getFunder() === $this) {
                $funding->setFunder(null);
            }
        }

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
            $romp->setContact($this);
        }

        return $this;
    }

    public function removeRomp(Romp $romp): self
    {
        if ($this->romps->removeElement($romp)) {
            // set the owning side to null (unless already changed)
            if ($romp->getContact() === $this) {
                $romp->setContact(null);
            }
        }

        return $this;
    }

    public function getUserAuth(): ?User
    {
        return $this->userAuth;
    }

    public function setUserAuth(?User $userAuth): self
    {
        $this->userAuth = $userAuth;

        return $this;
    }
}
