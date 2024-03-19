<?php

namespace App\Entity;

use App\Repository\JobToCandidatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobToCandidatRepository::class)]
class JobToCandidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'jobToCandidats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JobOffer $id_JobOffer = null;

    #[ORM\ManyToOne(inversedBy: 'jobToCandidats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidats $id_Candidat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $is_approved = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdJobOffer(): ?JobOffer
    {
        return $this->id_JobOffer;
    }

    public function setIdJobOffer(?JobOffer $id_JobOffer): static
    {
        $this->id_JobOffer = $id_JobOffer;

        return $this;
    }

    public function getIdCandidat(): ?Candidats
    {
        return $this->id_Candidat;
    }

    public function setIdCandidat(?Candidats $id_Candidat): static
    {
        $this->id_Candidat = $id_Candidat;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function isIsApproved(): ?bool
    {
        return $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): static
    {
        $this->is_approved = $is_approved;

        return $this;
    }
}
