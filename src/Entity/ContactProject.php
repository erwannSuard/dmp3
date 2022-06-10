<?php

namespace App\Entity;

use App\Repository\ContactProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactProjectRepository::class)]
class ContactProject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, columnDefinition:"TEXT CHECK (role_contact IN ('Coordinator', 'WP_Leader', 'WP_Participant', 'DMP_Leader'))")]
    private $roleContact;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private $contact;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleContact(): ?string
    {
        return $this->roleContact;
    }

    public function setRoleContact(string $roleContact): self
    {
        $this->roleContact = $roleContact;

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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
