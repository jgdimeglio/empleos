<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
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
    private $title;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
