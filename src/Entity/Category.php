<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: JobOffer::class, mappedBy: 'id_category')]
    private Collection $JobOffer;

    public function __construct()
    {
        $this->JobOffer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

        public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, JobOffer>
     */
    public function getJobOffer(): Collection
    {
        return $this->JobOffer;
    }

    public function addJobOffer(JobOffer $jobOffer): static
    {
        if (!$this->JobOffer->contains($jobOffer)) {
            $this->JobOffer->add($jobOffer);
            $jobOffer->setIdCategory($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): static
    {
        if ($this->JobOffer->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getIdCategory() === $this) {
                $jobOffer->setIdCategory(null);
            }
        }

        return $this;
    }
}
