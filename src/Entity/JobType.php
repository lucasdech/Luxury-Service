<?php

namespace App\Entity;

use App\Repository\JobTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTypeRepository::class)]
class JobType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(targetEntity: JobOffer::class, mappedBy: 'id_JobType')]
    private Collection $jobOffer;

    public function __construct()
    {
        $this->jobOffer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string 
    {
        return $this->type;
    }

    /**
     * @return Collection<int, JobOffer>
     */
    public function getJobOffer(): Collection
    {
        return $this->jobOffer;
    }

    public function addJobOffer(JobOffer $jobOffer): static
    {
        if (!$this->jobOffer->contains($jobOffer)) {
            $this->jobOffer->add($jobOffer);
            $jobOffer->setIdJobType($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): static
    {
        if ($this->jobOffer->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getIdJobType() === $this) {
                $jobOffer->setIdJobType(null);
            }
        }

        return $this;
    }
}
