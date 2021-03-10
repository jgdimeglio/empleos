<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", columnDefinition="ENUM('DNI', 'LC', 'LE', 'Pasaporte', 'CI')")
     */
    private $documentType;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=36)
     */
    private $documentNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=90)
     */
    private $mail;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="text")
     */
    private $experience;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $career;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="integer")
     */
    private $yearCareer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $published;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="student", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    public function setDocumentType(string $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber(string $documentNumber): self
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

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

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCareer(): ?string
    {
        return $this->career;
    }

    public function setCareer(string $career): self
    {
        $this->career = $career;

        return $this;
    }

    public function getYearCareer(): ?int
    {
        return $this->yearCareer;
    }

    public function setYearCareer(int $yearCareer): self
    {
        $this->yearCareer = $yearCareer;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(?\DateTimeInterface $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
