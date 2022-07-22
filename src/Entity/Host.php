<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HostRepository::class)]
class Host
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $hostName;

    #[ORM\Column(type: 'text')]
    private $hostDescription;

    #[ORM\Column(type: 'text')]
    private $hostUrl;

    #[ORM\Column(type: 'text', nullable: true)]
    private $pidSystem;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $supportVersionning;

    #[ORM\Column(type: 'text', nullable: true)]
    private $certifiedWith;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: Distribution::class)]
    private $distribution;

    public function __construct()
    {
        $this->distribution = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHostName(): ?string
    {
        return $this->hostName;
    }

    public function setHostName(string $hostName): self
    {
        $this->hostName = $hostName;

        return $this;
    }

    public function getHostDescription(): ?string
    {
        return $this->hostDescription;
    }

    public function setHostDescription(string $hostDescription): self
    {
        $this->hostDescription = $hostDescription;

        return $this;
    }

    public function getHostUrl(): ?string
    {
        return $this->hostUrl;
    }

    public function setHostUrl(string $hostUrl): self
    {
        $this->hostUrl = $hostUrl;

        return $this;
    }

    public function getPidSystem(): ?string
    {
        return $this->pidSystem;
    }

    public function setPidSystem(?string $pidSystem): self
    {
        $this->pidSystem = $pidSystem;

        return $this;
    }

    public function isSupportVersionning(): ?bool
    {
        return $this->supportVersionning;
    }

    public function setSupportVersionning(?bool $supportVersionning): self
    {
        $this->supportVersionning = $supportVersionning;

        return $this;
    }

    public function getCertifiedWith(): ?string
    {
        return $this->certifiedWith;
    }

    public function setCertifiedWith(?string $certifiedWith): self
    {
        $this->certifiedWith = $certifiedWith;

        return $this;
    }

    /**
     * @return Collection<int, Distribution>
     */
    public function getDistribution(): Collection
    {
        return $this->distribution;
    }

    public function addDistribution(Distribution $distribution): self
    {
        if (!$this->distribution->contains($distribution)) {
            $this->distribution[] = $distribution;
            $distribution->setHost($this);
        }

        return $this;
    }

    public function removeDistribution(Distribution $distribution): self
    {
        if ($this->distribution->removeElement($distribution)) {
            // set the owning side to null (unless already changed)
            if ($distribution->getHost() === $this) {
                $distribution->setHost(null);
            }
        }

        return $this;
    }
}
