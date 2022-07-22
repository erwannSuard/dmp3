<?php

namespace App\Entity;

use App\Repository\LicenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenceRepository::class)]
class Licence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $url;

    #[ORM\OneToMany(mappedBy: 'licence', targetEntity: Distribution::class)]
    private $distributions;

    public function __construct()
    {
        $this->distributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

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
            $distribution->setLicence($this);
        }

        return $this;
    }

    public function removeDistribution(Distribution $distribution): self
    {
        if ($this->distributions->removeElement($distribution)) {
            // set the owning side to null (unless already changed)
            if ($distribution->getLicence() === $this) {
                $distribution->setLicence(null);
            }
        }

        return $this;
    }
}
