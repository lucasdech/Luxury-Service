<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 255)]
    private ?string $job_title = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closing_date = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_date = null;

    #[ORM\OneToMany(targetEntity: JobToCandidat::class, mappedBy: 'id_JobOffer')]
    private Collection $jobToCandidats;

    #[ORM\ManyToOne(inversedBy: 'JobOffer')]
    private ?Category $id_category = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffer')]
    private ?JobType $id_JobType = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function __construct()
    {
        $this->jobToCandidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(string $job_title): static
    {
        $this->job_title = $job_title;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(?\DateTimeInterface $closing_date): static
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(?\DateTimeInterface $created_date): static
    {
        $this->created_date = $created_date;

        return $this;
    }

    /**
     * @return Collection<int, JobToCandidat>
     */
    public function getJobToCandidats(): Collection
    {
        return $this->jobToCandidats;
    }

    public function addJobToCandidat(JobToCandidat $jobToCandidat): static
    {
        if (!$this->jobToCandidats->contains($jobToCandidat)) {
            $this->jobToCandidats->add($jobToCandidat);
            $jobToCandidat->setIdJobOffer($this);
        }

        return $this;
    }

    public function removeJobToCandidat(JobToCandidat $jobToCandidat): static
    {
        if ($this->jobToCandidats->removeElement($jobToCandidat)) {
            // set the owning side to null (unless already changed)
            if ($jobToCandidat->getIdJobOffer() === $this) {
                $jobToCandidat->setIdJobOffer(null);
            }
        }

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): static
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdJobType(): ?JobType
    {
        return $this->id_JobType;
    }

    public function setIdJobType(?JobType $id_JobType): static
    {
        $this->id_JobType = $id_JobType;

        return $this;
    }

     public function __toString(): string
    {
        return $this->reference;
    }

     public function getClient(): ?Client
     {
         return $this->client;
     }

     public function setClient(?Client $client): static
     {
         $this->client = $client;

         return $this;
     }

}

