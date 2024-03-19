<?php

namespace App\Entity;

use App\Repository\CandidatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatsRepository::class)]
class Candidats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Gender = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_passPort = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passPort_files = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profil_picture = null;

    #[ORM\Column(length: 255)]
    private ?string $current_location = null;

    #[ORM\Column(length: 255)]
    private ?string $date_of_birth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $passWord = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $aviability = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $note = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_updated = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_delete = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\OneToMany(targetEntity: JobToCandidat::class, mappedBy: 'id_Candidat')]
    private Collection $jobToCandidats;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    private ?Experience $id_experience = null;

    public function __construct()
    {
        $this->jobToCandidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(?string $Gender): static
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function isIsPassPort(): ?bool
    {
        return $this->is_passPort;
    }

    public function setIsPassPort(?bool $is_passPort): static
    {
        $this->is_passPort = $is_passPort;

        return $this;
    }

    public function getPassPortFiles(): ?string
    {
        return $this->passPort_files;
    }

    public function setPassPortFiles(?string $passPort_files): static
    {
        $this->passPort_files = $passPort_files;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getProfilPicture(): ?string
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(?string $profil_picture): static
    {
        $this->profil_picture = $profil_picture;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->current_location;
    }

    public function setCurrentLocation(string $current_location): static
    {
        $this->current_location = $current_location;

        return $this;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(string $date_of_birth): static
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassWord(): ?string
    {
        return $this->passWord;
    }

    public function setPassWord(string $passWord): static
    {
        $this->passWord = $passWord;

        return $this;
    }

    public function getAviability(): ?\DateTimeInterface
    {
        return $this->aviability;
    }

    public function setAviability(?\DateTimeInterface $aviability): static
    {
        $this->aviability = $aviability;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(?\DateTimeInterface $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->date_updated;
    }

    public function setDateUpdated(?\DateTimeInterface $date_updated): static
    {
        $this->date_updated = $date_updated;

        return $this;
    }

    public function getDateDelete(): ?\DateTimeInterface
    {
        return $this->date_delete;
    }

    public function setDateDelete(?\DateTimeInterface $date_delete): static
    {
        $this->date_delete = $date_delete;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

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
            $jobToCandidat->setIdCandidat($this);
        }

        return $this;
    }

    public function removeJobToCandidat(JobToCandidat $jobToCandidat): static
    {
        if ($this->jobToCandidats->removeElement($jobToCandidat)) {
            // set the owning side to null (unless already changed)
            if ($jobToCandidat->getIdCandidat() === $this) {
                $jobToCandidat->setIdCandidat(null);
            }
        }

        return $this;
    }

    public function getIdExperience(): ?Experience
    {
        return $this->id_experience;
    }

    public function setIdExperience(?Experience $id_experience): static
    {
        $this->id_experience = $id_experience;

        return $this;
    }
}
